<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\GoalController;
use Illuminate\Support\Facades\Route;

// ----------------- 認証 -----------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ----------------- 会員登録 -----------------
Route::get('/register/step1', [AuthController::class, 'showRegisterStep1'])->name('register.step1');
Route::post('/register/step1', [AuthController::class, 'registerStep1']);
Route::get('/register/step2', [AuthController::class, 'showRegisterStep2'])->name('register.step2');
Route::post('/register/step2', [AuthController::class, 'registerStep2']);

// ----------------- 体重ログ -----------------
Route::prefix('weight_logs')->group(function () {

    Route::get('/', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::get('/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
    Route::post('/', [WeightLogController::class, 'store'])->name('weight_logs.store');

    Route::get('/search', [WeightLogController::class, 'search'])->name('weight_logs.search');

    Route::get('/{weightLog}', [WeightLogController::class, 'show'])->name('weight_logs.show');
    Route::patch('/{weightLog}', [WeightLogController::class, 'update'])->name('weight_logs.update');
    Route::delete('/{weightLog}', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');

    Route::get('/goal_setting', [GoalController::class, 'edit'])->name('weight_logs.goal.edit');
    Route::patch('/goal_setting', [GoalController::class, 'update'])->name('weight_logs.goal.update');
});