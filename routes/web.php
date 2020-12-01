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
Route::middleware(['auth:sanctum', 'verified'])->resource('/categories', 'App\Http\Controllers\CategoryController');
Route::middleware(['auth:sanctum', 'verified'])->resource('/genders', 'App\Http\Controllers\GenderController');
Route::middleware(['auth:sanctum', 'verified'])->resource('/colors', 'App\Http\Controllers\ColorController');
Route::middleware(['auth:sanctum', 'verified'])->resource('/sizes', 'App\Http\Controllers\SizeController');
Route::middleware(['auth:sanctum', 'verified'])->resource('/brands', 'App\Http\Controllers\BrandController');

Route::middleware(['auth:sanctum', 'verified'])->resource('/entries', 'App\Http\Controllers\EntryController');
Route::middleware(['auth:sanctum', 'verified'])->post('fetchEntries', 'App\Http\Controllers\EntryController@fetchEntries');

Route::middleware(['auth:sanctum', 'verified'])->resource('/inventory_exits', 'App\Http\Controllers\ExitController');
Route::middleware(['auth:sanctum', 'verified'])->post('fetchExits', 'App\Http\Controllers\ExitController@fetchExits');

Route::middleware(['auth:sanctum', 'verified'])->resource('/reports', 'App\Http\Controllers\ReportController');