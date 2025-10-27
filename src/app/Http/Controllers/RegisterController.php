<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;

class RegisterController extends Controller
{
    // STEP1 表示
    public function showStep1()
    {
        return view('auth.register_step1');
    }

    // STEP1 登録
    public function storeStep1(RegisterStep1Request $request)
    {
        session([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('register.step2');
    }

    // STEP2 表示
    public function showStep2()
    {
        return view('auth.register_step2');
    }

    // STEP2 登録（ユーザーと初期体重登録）
    public function storeStep2(RegisterStep2Request $request)
    {
        $user = User::create([
            'name' => session('name'),
            'email' => session('email'),
            'password' => session('password'),
        ]);

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => $request->goal_weight,
        ]);

        // 初期体重は weight_logs にも登録しておく
        $user->weightLogs()->create([
            'date' => now(),
            'weight' => $request->current_weight,
        ]);

        Auth::login($user);
        session()->forget(['name', 'email', 'password']);

        return redirect()->route('weight_logs.index');
    }

}