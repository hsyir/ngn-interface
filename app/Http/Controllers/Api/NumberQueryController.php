<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Hsy\Ngn\Center;
use Illuminate\Http\Request;

class NumberQueryController extends Controller
{
    public function search(Request $request)
    {


        $validator = \Validator::make($request->all(), [
            "pre_number" => "required|digits:3",
            "mid_number" => "required|digits:4",
            "number" => "required|digits:4",
        ]);

        if ($validator->fails())
            return $this->error($validator->errors(), 422);


        try {
            $ngnCenter = new Center();
            $result = $ngnCenter->search($request->pre_number, $request->mid_number, $request->number);

        } catch (\Exception $e) {
            return $this->error(
                ["pre_number" => $e->getMessage()],
                422
            );
        }
        return response()->json(
            $result
        );

    }

    /**
     * @param $errors
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    private function error($errors, $code)
    {
        return response()->json([
            "success" => false,
            "code" => $code,
            "errors" => $errors
        ], $code);
    }
}
