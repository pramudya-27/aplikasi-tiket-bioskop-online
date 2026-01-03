<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route untuk Homepage User
Route::get('/', function () {
    return view('pages.front.home.index');
})->name('home');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard User
Route::get('/dashboard', function () {
    return view('pages.front.user.dashboard');
})->middleware('auth')->name('user.dashboard');

Route::get('/genre/{slug?}', function ($slug = null) {
    return view('pages.front.genre.index', ['slug' => $slug]);
})->name('genre.show');

// Keep the base route for backward compatibility if needed, but point to the same view
Route::get('/genre', function () {
    return view('pages.front.genre.index', ['slug' => null]);
})->name('genre');

Route::get('/a-z-list/{letter?}', function ($letter = null) {
    return view('pages.front.az-list.index', ['letter' => $letter]);
})->name('az-list');

Route::get('/search', function (\Illuminate\Http\Request $request) {
    $query = $request->input('q');
    return view('pages.front.search.index', ['query' => $query]);
})->name('search');