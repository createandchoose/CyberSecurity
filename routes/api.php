<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("auth")->controller(AuthController::class)->group(function () {
   Route::post("register", 'register');
   Route::post("login", "login");
});

Route::prefix("tests")->controller(TestController::class)->group(function () {
   Route::get("get", 'index');
   Route::get("test", "get");
   Route::middleware('auth:sanctum')->post("pass", "pass");
});

Route::prefix("courses")->controller(CourseController::class)->group(function () {
    Route::get("get", 'index');
    Route::get("course", "get");
    Route::middleware('auth:sanctum')->post("pass", "pass");
});
