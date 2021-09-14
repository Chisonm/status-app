<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::namespace('App\Http\Controllers')->group(function () {
    // user home
    Route::middleware('auth')->group(function () {
        Route::get('/approval', 'HomeController@approval')->name('approval');
    });

    Route::middleware(['auth','approved-user'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
    });

    Route::prefix('admin')->group(function () {
        Route::middleware(['auth','admin'])->group(function () {
            Route::get('dashboard', 'HomeController@adminHome')->name('admin.index');
            Route::get('/users','UsersController@index')->name('users.index');
            Route::post('/aprove-user/{id}','UsersController@approveUser')->name('approve.user');
        });
    });
});
