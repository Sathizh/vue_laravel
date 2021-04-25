<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('getContacts','ContactController@getContact');
Route::post('save_contact','ContactController@save_contact');
Route::get('search_contact/{id}','ContactController@search_contact');
Route::post('update_contact/{id}','ContactController@update_contact');
Route::delete('delete_contact/{id}','ContactController@deleteContaact');
