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
            "pre_number" => "required|in:021,051",
            "mid_number" => "required|digits:4",
            "number" => "required|digits:4",
        ]);

        if ($validator->fails())
            return response()->json([
                "success" => false,
                "code" => "422",
                "errors" => $validator->errors()
            ], 422);


        try {

            $ngnCenter = new Center();
            $result = $ngnCenter->search($request->pre_number, $request->mid_number, $request->number);



        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "code" => "422",
                "errors" => ["pre_number" => "pre number not defined"]
            ], 422);
        }
        dd($result);

    }
}
