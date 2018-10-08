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

// Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'VisitController@dashboard');

Route::middleware('admin')->prefix('management')->group(function () {
    Route::resource('user', 'UserController');
    Route::resource('station', 'StationController');
    Route::resource('patient', 'PatientController');
    Route::resource('visit', 'VisitController');
});

Route::resource('visit', 'VisitController')->only([
    'create', 'store', 'destroy'
]);

Route::get('queue/{sid}/{date?}', 'VisitController@show_queue');
Route::get('visit/history/{id}', 'VisitController@history');
Route::put('visit/checkout', 'VisitController@checkout');