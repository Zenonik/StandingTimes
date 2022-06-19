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
    return view('welcome');
});

Auth::routes();

Route::post('/newEntry', [App\Http\Controllers\StandingController::class, 'newEntry'])->middleware('auth')->name('newEntryForUser');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::post('/save_profile', [App\Http\Controllers\ProfileController::class, 'saveProfile'])->middleware('auth')->name('save_profile');
