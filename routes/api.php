<?php

use App\Http\Middleware\AllowedAuthProviders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
    Route::post('auth/register', 'API\AuthController@register');
    Route::post('auth', 'API\AuthController@login');
    Route::get('user', 'API\UserController@index');

    // Social
    Route::get('auth/social', 'API\AuthController@loginSocial');
    Route::get('auth/{provider}', 'API\AuthController@redirectToProvider')->middleware(['allowedAuthProviders', 'web']);
    Route::get('auth/{provider}/callback', 'API\AuthController@handleProviderCallback')->middleware(['allowedAuthProviders', 'web']);

    // Route::get('user', 'API\AuthController@userFromJwt')->middleware('auth.api');
    
    // Offices
    Route::resource('offices', 'API\OfficesController')->except(['show']);
    Route::get('offices/{slug}', 'API\OfficesController@findSlug');

    // Hotel
    Route::resource('hotel', 'API\HotelController')->except(['show']);
    Route::get('hotel/{slug}', 'API\HotelController@findSlug');

    Route::resource('employers', 'API\EmployerController');

    // REDIS TESTS
    Route::get('redisping', function () {
        return Redis::command('ping');
    });

    Route::get('redisput', function () {
        return Redis::set('name', 'Test');
    });

    Route::get('redisget', function () {
        return Redis::get('name');
    });
});