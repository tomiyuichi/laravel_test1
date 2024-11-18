<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     // return view('welcome');
//     return view('home');
// });
// Use middleware to avoid non logged in User reaches to /home
Route::get('/', function () {
    return view('home');
})->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/logout', function () {
//     Auth::logout();
//     return redirect('/login'); // ログアウト後のリダイレクト先を指定
// });

// LogoutController
use App\Http\Controllers\LogoutController;
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// ProfileController
use App\Http\Controllers\ProfileController;
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');