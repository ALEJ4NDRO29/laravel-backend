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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
    Route::resource('offices', 'API\OfficesController'); // ->only(['index', 'show']);
    Route::resource('employers', 'API\EmployerController');

    Route::get('tags', function () {
        error_log('hola');
        return json_encode(array('hola', 'pipo'));
    });
});