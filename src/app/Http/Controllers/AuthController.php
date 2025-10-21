<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ログイン画面表示
    public function showLogin()
    {
        return view('auth.login');
    }

     // STEP1 表示
    public function showRegisterStep1()
    {
        return view('auth.register_step1');
    }

    // STEP1 保存 → STEP2へ
    public function registerStep1(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

         // STEP1情報をセッションに保存
        Session::put('register_data', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/register/step2');
    }

// STEP2 表示
    public function showRegisterStep2()
    {
        return view('auth.register_step2');
    }

    // STEP2 登録処理
    public function registerStep2(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric|min:1',
            'goal_weight' => 'required|numeric|min:1',
        ]);

        $data = Session::get('register_data');

          // ユーザー作成
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'weight' => $request->weight,
            'goal_weight' => $request->goal_weight,
        ]);

         // セッション消去
        Session::forget('register_data');

        Auth::login($user);

        return redirect('/admin')->with('success', '登録が完了しました！');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
