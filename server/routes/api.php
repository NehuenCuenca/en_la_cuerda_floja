<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\BrandController;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserAuthController;

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

Route::post('/register', [UserAuthController::class, 'register_user'])->name('api-register');
Route::post('/login', [UserAuthController::class, 'login_user'])->name('api-login');
Route::middleware('auth:sanctum')->get('/logout', [UserAuthController::class, 'logout_user'])->name('api-logout');
Route::middleware('auth:sanctum')->get('/verify-token', [UserAuthController::class, 'verify_token'])->name('api-verify-token');;