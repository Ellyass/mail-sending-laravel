<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CourseController;

Route::get('/anasayfa', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/mailsend','App\Http\Controllers\PageController@index')->name('mailsend');
Route::post('/mailsendpost','App\Http\Controllers\PageController@sendMail')->name('sendpost');
