<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WeightLogController;

// ----------------- 認証 -----------------
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ----------------- 会員登録 -----------------
Route::get('/register/step1', [RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'storeStep1']);
Route::get('/register/step2', [RegisterController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'storeStep2']);

// ----------------- 体重ログ -----------------
Route::prefix('weight_logs')->group(function () {

    // 管理画面（トップページ）
    Route::get('/', [WeightLogController::class, 'index'])->name('weight_logs.index');
    // 体重登録
    Route::get('/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
    // 体重登録処理
    Route::post('/create', [WeightLogController::class, 'store'])->name('weight_logs.store');
    // 体重検索
    Route::get('/search', [WeightLogController::class, 'search'])->name('weight_logs.search');

    // 目標設定
    Route::get('/goal_setting', [WeightLogController::class, 'goalSetting'])->name('weight_logs.goal.edit');
    Route::patch('/goal_setting', [WeightLogController::class, 'updateGoal'])->name('weight_logs.goal.update');

    // 編集画面（data.blade.php を使用）
    Route::get('/{weightLog}/edit', [WeightLogController::class, 'show'])->name('weight_logs.edit');
    // 体重詳細
    Route::get('/{weightLog}', [WeightLogController::class, 'show'])->name('weight_logs.show');
    // 体重更新
    Route::patch('/{weightLog}/update', [WeightLogController::class, 'update'])->name('weight_logs.update');
    // 体重削除
    Route::delete('/{weightLog}/delete', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');
});