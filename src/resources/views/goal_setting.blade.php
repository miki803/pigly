@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css')}}">
@endsection

@section('content')

<div class="goal_setting__group">
    <label class="goal_setting__label" for="weight">目標体重設定</label>
    <input class="goal_setting__input" type="number" name="goal_weight" id="goal_weight" placeholder="{{ $user->goal_weight }}">kg
    <p class="goal_setting__error-message">
        @error('weight')
        {{ $message }}
        @enderror
    </p>

    <div class="button-content">
        <a href="/products" class="back">戻る</a>
        <button type="submit" class="button-change">更新</button>
    </div>
</div>
@endsection