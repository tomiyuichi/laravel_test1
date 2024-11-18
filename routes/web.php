<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    // return view('home');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login'); // ログアウト後のリダイレクト先を指定
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
