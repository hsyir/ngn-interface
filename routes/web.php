<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/import', function () {
    \Hsy\Ngn\Models\Number::truncate();
    \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\ImportNumbers,\Illuminate\Support\Facades\Storage::path("ngn.xlsx"));
});

Route::get("/test",function(){
    $ngn = new \Hsy\Ngn\Center();
    $ngn->search("021","9130","2222");
});

// api response
/*
 *  api response
 *  success =>  true
 *              false
 *
 *  data =>     number     02191051234
 *              prenumber  021
 *              midnumber  9105
 *              price       2000000
 *              category   طلایی
 *              status     =>   'green' -> free
 *                              'red'-> registered
 *                              'orange'-> reserved
 *                              'gray'-> unknown
 *
 *
 *
 *آزاد (سبز)
ثبت شده (قرمز)
رزرو شده (نارنجی)
نامشخص (خاکستری)
 */



