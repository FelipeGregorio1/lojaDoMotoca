<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;

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

require __DIR__.'/auth.php';

Route::get('/category/create', [CategoryController::class, 'create']);
Route::post('/category', [CategoryController::class, 'store']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/edit/{category}', [CategoryController::class, 'edit']);
Route::post('/category/update/{category}', [CategoryController::class, 'update']);
Route::get('/category/delete/{category}', [CategoryController::class, 'destroy']);

Route::get('/product/create', [ProductController::class, 'create']);
Route::post('/product', [ProductController::class, 'store']);
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/edit/{product}', [ProductController::class, 'edit']);
Route::post('/product/update/{product}', [ProductController::class, 'update']);
Route::get('/product/delete/{product}', [ProductController::class, 'destroy']);

Route::get('/tag/create', [TagController::class, 'create']);
Route::post('/tag', [TagController::class, 'store']);
Route::get('/tag', [TagController::class, 'index']);
Route::get('/tag/edit/{tag}', [TagController::class, 'edit']);
Route::post('/tag/update/{tag}', [TagController::class, 'update']);
Route::get('/tag/delete/{tag}', [TagController::class, 'destroy']);