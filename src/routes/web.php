<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeightLogController;
use Illuminate\Support\Facades\Route;

// ログイン・登録関連
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register/step1', [AuthController::class, 'showRegisterStep1'])->name('register.step1');
Route::post('/register/step1', [AuthController::class, 'registerStep1']);
Route::get('/register/step2', [AuthController::class, 'showRegisterStep2'])->name('register.step2');
Route::post('/register/step2', [AuthController::class, 'registerStep2']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 管理画面
Route::get('/admin', [WeightLogController::class, 'index'])->name('admin');

// 情報更新画面
Route::get('/data/{id}', [WeightLogController::class, 'edit'])->name('data.edit');
Route::post('/data/{id}', [WeightLogController::class, 'update'])->name('data.update');

// 目標体重設定
Route::get('/goal_setting', [GoalController::class, 'edit'])->name('goal.edit');
Route::post('/goal_setting', [GoalController::class, 'update'])->name('goal.update');

// 体重記録削除
Route::post('/weight_logs/{id}/delete', [WeightLogController::class, 'destroy'])->name('weight.delete');