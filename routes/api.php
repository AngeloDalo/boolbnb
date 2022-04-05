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


Route::get('/v1/apartments', 'Api\ApartmentController@index');
// Route::get('/posts/random', 'Api\PostController@inRandomOrder');
Route::get('/v1/apartments/{id}', 'Api\ApartmentController@show');
Route::get('/v1/services', 'Api\ServiceController@index');
Route::post('/v1/apartments/search', 'Api\ApartmentController@search'); 
Route::post('v1/contacts', 'Api\ContactController@store');
Route::get('/v1/contacts/user', 'Api\ContactController@index');