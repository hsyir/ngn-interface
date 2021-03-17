<?php


namespace App\Classes\NgnDrivers;


use Hsy\Ngn\Drivers\DriverInterface;
use Hsy\Ngn\SearchResponse;
use Illuminate\Support\Facades\Http;

class ApiDriver implements DriverInterface
{
    public function query($preNumber, $midNumber, $number): ?SearchResponse
    {
        $url = "https://telefonchy.com/api/v1/wizard/recommend";
        $res = Http::get($url, ["number" => $midNumber . $number, "prenumber" => $preNumber]);

        $data = $res->json()["data"]['trunks'];
        if(count($data)<1)
            return null;

        $numberStatus = $data[0];

        $response = new SearchResponse;
        $response->number = $number;
        $response->preNumber = $preNumber;
        $response->midNumber = $midNumber;
        $response->category = $numberStatus["type"]["text"];
        $response->price = $numberStatus["price_real"];

        return $response;






    }
}
