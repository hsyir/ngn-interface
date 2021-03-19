<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SearchRequest;
use Hsy\Ngn\Exceptions\NotDefinedPreNumber;
use App\Http\Controllers\Controller;
use Hsy\Ngn\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NumberQueryController extends Controller
{

    const RES_OK = 100;
    const RES_NOT_FIND = 110;
    const RES_BAD_ENTRY = 111;
    const RES_NOT_DEFINED_PRE_NUMBERS = 112;
    const RES_ERROR = 120;

    public function search(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->searchRequestValidationRules());

        $preNumber = $request->pre_number;
        $midNumber = $request->mid_number;
        $number = $request->number;


        if ($validator->fails())
            return $this->error($validator->errors(), self::RES_BAD_ENTRY);

        try {

            $ngnCenter = new Center();
            $result = $ngnCenter->search($preNumber, $midNumber, $number);

        } catch (NotDefinedPreNumber $e) {
            $message = "Not defined pre-number: {$preNumber}{$midNumber}";
            return $this->error($message, self::RES_NOT_DEFINED_PRE_NUMBERS);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), self::RES_ERROR);
        }
        return ($result)
            ? $this->resultResponse($result->toArray())
            : $this->error(["No Result"], self::RES_NOT_FIND);

    }

    /**
     * @param $error
     * @param null $resultCode
     * @return \Illuminate\Http\JsonResponse
     */
    private function error($error, $resultCode = null)
    {
        return response()->json([
            "success" => false,
            "code" => $resultCode,
            "errors" => $error
        ], 400);
    }

    /**
     * @return string[]
     */
    private function searchRequestValidationRules(): array
    {
        return [
            "pre_number" => "required|digits:3",
            "mid_number" => "required|digits:4",
            "number" => "required",
        ];
    }

    private function resultResponse($ngnResponse)
    {
        return response()->json(
            [
                "success" => true,
                "code" => self::RES_OK,
                "result" => $ngnResponse
            ]
        );
    }
}
