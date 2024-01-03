<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// USER AUTH
Route::post('/register', [UserAuthController::class, 'register_user'])->name('api-register');
Route::post('/login', [UserAuthController::class, 'login_user'])->name('api-login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [UserAuthController::class, 'logout_user'])->name('api-logout');
    Route::get('/verify-token', [UserAuthController::class, 'verify_token'])->name('api-verify-token');
});

// PRODUCTS
Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::get('/products/category/{category}', [ProductController::class, 'getProductsByCategory']);
Route::get('/products/brand/{brand}', [ProductController::class, 'getProductsByBrand']);
Route::get('/products/filter', [ProductController::class, 'getProductsByFilters']);
Route::get('/product/{id}', [ProductController::class, 'getProductById']);

// BRANDS
Route::get('/brands', [BrandController::class, 'getAllBrands']);

// Category
Route::get('/categories', [CategoryController::class, 'getAllCategories']);