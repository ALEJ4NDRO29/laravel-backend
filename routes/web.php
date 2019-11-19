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

Route::get('/', function () {
    dd(shell_exec('php ../artisan route:list'));
    // return view('welcome');
});


Route::get('/api', function() {
    dd(shell_exec('php ../artisan route:list'));
});

// Route::group(['prefix' => 'api/hotels'], function(){
//     Route::get('get', 'PrimerTest@index');
//     Route::get('get/{id}', 'PrimerTest@getById');
// });

