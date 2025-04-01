<?php

use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GroupController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/group/{group}', [GroupController::class, 'show'])->name('group.show');
Route::get('/group/{group}/products', [GroupController::class, 'indexProducts'])->name('group.index.products');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');

