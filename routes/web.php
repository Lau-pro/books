<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/list-of-books', [BookController::class, 'index'])->name('book.view');
    Route::get('/new-book', [BookController::class, 'create'])->name('book.add');
    Route::post('/new-book', [BookController::class, 'store'])->name('book.store');
    Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::post('/book/{id}/update', [BookController::class, 'update'])->name('book.update');
    Route::delete('/list-of-book/{id}/del', [BookController::class, 'destroy'])->name('book.del');
});




require __DIR__ . '/auth.php';
