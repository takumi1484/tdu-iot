<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');



Route::group(['prefix' => 'device'], function () {//区分
    Route::post('/add','HomeController@addDevice');
    Route::delete('/{id}', 'HomeController@deleteDevice');
});
Route::group(['prefix' => 'button'], function () {//区分
    Route::post('/add','HomeController@addButton');
    Route::get('/edit/{id}','HomeController@editButton');
    Route::delete('/{id}', 'HomeController@deleteButton');
    Route::get('/study/{id}','HomeController@study');
//    Route::get('/study/{id}','HomeController@study')->middleware('check.button');
});

