<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationCancel;
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

Auth::routes();
Route::get('/set-language/{lang}', 'LanguagesController@set')->name('set.language');


Route::group(['middleware' => 'LanguageSwitcher'], function () {


    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('/fast-login', function () {
        return view('auth.fast-login');
    })->name('fast-login');


    Route::post('/fast-auth', 'Auth\LoginController@fastAuth')->name('fast-auth');

    Route::get('/authentication', function () {
        return view('auth.authentication');
    })->name('authentication');

    Route::post('/verify', 'Auth\LoginController@verify')->name('fast-verify');


    Route::middleware('auth')->group(function () {

        Route::get('/home', 'HomeController@index')->middleware('LanguageSwitcher')->name('home');
        Route::get('/create', 'HomeController@create')->name('create');
        Route::post('/store', 'HomeController@store')->name('store');
        Route::get('/destroy/{id}', 'HomeController@destroy')->name('destroy');

    });

    Route::middleware(['auth', 'admin'])->group(function () {

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/clients', 'DashboardController@clients')->name('clients');
        Route::get('/settings', 'SettingsController@index')->name('settings');

        Route::get('/status/{id}', 'SettingsController@changeStatus')->name('change.status');

        Route::get('/cancel/{id}', 'DashboardController@cancel')->name('cancel');
        Route::get('/confirm/{confirm}', 'DashboardController@confirm')->name('confirm');

        Route::get('/block/{id}', 'DashboardController@block')->name('block');
        Route::get('/unblock/{id}', 'DashboardController@unblock')->name('unblock');
    });
});
