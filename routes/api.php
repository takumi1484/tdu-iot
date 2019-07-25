<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/{user_name}','apiController@get');
//Route::get('/send/{user_name}','apiController@getCode');
//Route::get('/{user_name}','apiController@get');
//Route::get('/get','apiController@get');


//Route::post('/','IRController@updateIR');


Route::group(['middleware' => 'api'], function() {
    Route::post('/study/success/{device_id}','apiController@addButton');
});

