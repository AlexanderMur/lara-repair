<?php

use App\Http\Controllers\ProfileController;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Auth/Login');
});


Route::group(['middleware'=>'auth'], function() {
    Route::get('/request', [\App\Http\Controllers\RequestController::class, 'show'])->name('request.create');
    Route::post('/request', [\App\Http\Controllers\RequestController::class, 'onSubmit']);
    Route::get('/profile/request', [ProfileController::class, 'showRequests'])->name('profile.requests');
    Route::delete('/profile/request/{request}', [ProfileController::class, 'deleteRequest']);

    Route::get('/profile/products', [ProfileController::class, 'showProducts'])->name('profile.products.index');
    Route::post('/profile/products', [ProfileController::class, 'onCreateProduct']);
    Route::get('/profile/products/create', [ProfileController::class, 'createProduct'])->name('profile.products.create');
    Route::get('/profile/products/{product}', [ProfileController::class, 'showProduct'])->name('profile.product.show');
    Route::put('/profile/products/{product}', [ProfileController::class, 'editProduct']);
    Route::delete('/profile/products/{product}', [ProfileController::class, 'deleteProduct']);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
