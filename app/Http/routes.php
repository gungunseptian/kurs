<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', ['uses'=>'HomeController@index']);

Route::get('/kurs-rupiah-hari-ini', ['uses'=>'HomeController@index']);

// kurs rupiah hari ini
Route::get('/kurs-{currency_code}-hari-ini', ['uses'=>'HomeController@listByCurrencyToday']);

// kurs dollar rupiah hari ini
Route::get('/kurs-{currency_code1}-{currency_code2}', ['uses'=>'HomeController@listByCurrencyCompare']);

Route::get('/kurs-{currency_code1}-{currency_code2}-hari-ini', ['uses'=>'HomeController@listByCurrencyCompareToday']);


Route::get('/cron', ['uses'=>'HomeController@cron']);
