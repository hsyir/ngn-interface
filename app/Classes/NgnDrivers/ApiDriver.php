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
        dd($res->body());
    }
}
