<?php

use App\Http\Controllers\StoreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// ================= ROTAS DO CLIENTE (VITRINE PÚBLICA) =================
Route::get('/', [StoreController::class, 'index'])->name('client.home');
Route::get('/loja/categoria/{id}', [StoreController::class, 'showCategory'])->name('client.category');

// ================= ROTAS DE QUALQUER USUÁRIO LOGADO (CLIENTE OU ADMIN) =================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================= ROTAS EXCLUSIVAS DO ADMIN (GERENCIAMENTO) =================
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Rotas de Categoria
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/create', [CategoryController::class, 'create']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit']);
    Route::post('/category/update/{category}', [CategoryController::class, 'update']);
    Route::get('/category/delete/{category}', [CategoryController::class, 'destroy']);

    // Rotas de Produto
    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/product/edit/{product}', [ProductController::class, 'edit']);
    Route::post('/product/update/{product}', [ProductController::class, 'update']);
    Route::get('/product/delete/{product}', [ProductController::class, 'destroy']);
});

require __DIR__.'/auth.php';