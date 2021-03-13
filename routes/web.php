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
    \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\ImportNumbers,\Illuminate\Support\Facades\Storage::path("ngn.xlsx"));'|'
});
