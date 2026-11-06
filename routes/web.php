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
Route::view('/sobre-nos', 'client.about')->name('client.about');
Route::view('/politica-de-privacidade', 'client.privacy')->name('client.privacy');
Route::view('/termos-de-uso', 'client.terms')->name('client.terms');
Route::view('/contato', 'client.contact')->name('client.contact');

// ================= ROTAS DE QUALQUER USUÁRIO LOGADO (CLIENTE OU ADMIN) =================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================= ROTAS EXCLUSIVAS DO ADMIN (GERENCIAMENTO) =================
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Rotas de Categoria
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Rotas de Produto
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});

require __DIR__.'/auth.php';