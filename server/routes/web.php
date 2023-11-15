<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("root");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('vendors', \App\Http\Controllers\VendorController::class)->middleware('auth');
Route::resource('vendors.contacts', \App\Http\Controllers\ContactController::class)->middleware('auth');

Route::post('users/{user}/activate', [\App\Http\Controllers\UserController::class, 'activate'])->name('users.activate')->middleware('auth');
Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('auth');

Route::post('dimensions/{dimension}/units', [\App\Http\Controllers\DimensionController::class, 'addUnit'])->name('dimensions.addUnit')->middleware('auth');
Route::resource('dimensions', \App\Http\Controllers\DimensionController::class)->middleware('auth');

// we need an explicit routes, as we combine two models into a single controller
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create/{type}', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{type}/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{type}/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{type}/{id}', [ProductController::class, 'update'])->name('products.update');
});

Route::resource('warehouses', \App\Http\Controllers\WarehouseController::class)->middleware('auth');

require __DIR__.'/auth.php';
