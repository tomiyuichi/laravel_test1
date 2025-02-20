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

use App\Http\Controllers\LogoutController;
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

use App\Http\Controllers\ProfileController;
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');

use App\Http\Controllers\CsvController;
Route::get('/upload', [CsvController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload', [CsvController::class, 'uploadCsv'])->name('upload.csv');

use App\Http\Controllers\Auto_mpg_Controller;
Route::get('/auto_mpg', [Auto_mpg_Controller::class, 'index'])->name('auto_mpg.index');
use App\Http\Controllers\Dynamic_mpg_Controller;
Route::get('/dynamic_mpg', [Dynamic_mpg_Controller::class, 'index'])->name('dynamic_mpg.index');

use App\Livewire\LiveMpgTable;
Route::get('/live_mpg', LiveMpgTable::class);
use App\Livewire\LivewireSamplePage;
Route::get('/livewire_sample', LivewireSamplePage::class);
use App\Livewire\LiveCount;
Route::get('/live_count', LiveCount::class);
use App\Livewire\LiveColumnMpg;
Route::get('/live_column_mpg', LiveColumnMpg::class);


use App\Http\Controllers\MarkdownController;
Route::get('/markdown', [MarkdownController::class, 'index'])->name('markdown.index');
// Route::get('/markdown/{fileName}', [MarkdownController::class, 'show'])->name('markdown.show');
Route::get('/markdown/{path}', [MarkdownController::class, 'show'])
     ->where('path', '.*')    // 任意のディレクトリ階層を受け入れる
     ->name('markdown.show'); // サブディレクトリを含むMarkdownファイル

use App\Livewire\TodoList;
Route::get('/todo_list', TodoList::class)->middleware('auth');



