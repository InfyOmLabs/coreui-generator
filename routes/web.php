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
    return view('welcome');
});


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UserController');
    Route::post('users/profile-update', 'UserController@profileUpdate')->name('update-profile');
    Route::post('users/change-password', 'UserController@changePassword')->name('change-password');
    Route::resource('roles', 'RoleController');
});