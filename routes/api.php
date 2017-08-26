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

Route::get('/git', 'TestController@getGithub');
Route::get('/account', 'TestController@getAccount');
Route::get('/token', 'TestController@getToken');

Route::get('/rate', 'BcaController@getRate');

Route::get('/user/{id}', 'BcaController@getUser');

Route::get('/fire/topup', 'FireController@getTopup');
Route::post('/fire/topup', 'FireController@topup');
