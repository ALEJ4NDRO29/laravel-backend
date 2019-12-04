<?php

use App\Http\Middleware\AllowedAuthProviders;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
    Route::post('auth/register', 'API\AuthController@register');
    Route::post('auth', 'API\AuthController@login');
    Route::get('user', 'API\UserController@index');

    // Social
    Route::get('auth/{provider}', 'API\AuthController@redirectToProvider')->middleware(['allowedAuthProviders', 'web']);
    Route::get('auth/{provider}/callback', 'API\AuthController@handleProviderCallback')->middleware(['allowedAuthProviders', 'web']);


    // Route::get('user', 'API\AuthController@userFromJwt')->middleware('auth.api');
    
    Route::resource('offices', 'API\OfficesController')->except(['show']);
    Route::get('offices/{slug}', 'API\OfficesController@findSlug');

    Route::resource('employers', 'API\EmployerController');

});