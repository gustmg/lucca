<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->resource('/products', 'App\Http\Controllers\ProductController');
Route::middleware(['auth:sanctum', 'verified'])->post('fetchProducts', 'App\Http\Controllers\ProductController@fetchProducts');
Route::middleware(['auth:sanctum', 'verified'])->resource('/product_categories', 'App\Http\Controllers\ProductCategoryController');
Route::middleware(['auth:sanctum', 'verified'])->resource('/product_genders', 'App\Http\Controllers\ProductGenderController');
Route::middleware(['auth:sanctum', 'verified'])->resource('/product_colors', 'App\Http\Controllers\ProductColorController');
Route::middleware(['auth:sanctum', 'verified'])->resource('/product_sizes', 'App\Http\Controllers\ProductSizeController');

Route::middleware(['auth:sanctum', 'verified'])->resource('/inventory_entries', 'App\Http\Controllers\InventoryEntryController');
Route::middleware(['auth:sanctum', 'verified'])->post('fetchInventoryEntries', 'App\Http\Controllers\InventoryEntryController@fetchInventoryEntries');


