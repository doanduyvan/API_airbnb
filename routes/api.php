<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('auth')->group(function () {
    // 🔓 Các route không yêu cầu đăng nhập
    Route::post('/signup', [AuthController::class, 'register']); // Đăng ký tài khoản
    Route::post('/login', [AuthController::class, 'login']);       // Đăng nhập

    // 🔒 Các route yêu cầu token JWT hợp lệ
    Route::middleware('auth:api')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);          // Lấy thông tin người dùng
        Route::post('/logout', [AuthController::class, 'logout']); // Đăng xuất
        Route::post('/refresh', [AuthController::class, 'refresh']); // Làm mới token
    });
});

