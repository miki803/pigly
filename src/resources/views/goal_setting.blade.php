@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}">
@endsection

@section('content')

<div class="goal_setting__inner">
    <form action="{{ route('weight_logs.goal.update') }}" method="post">
        @csrf
        @method('PATCH')

        <div class="goal_setting__group">
            <label class="goal_setting__label" for="goal_weight">目標体重設定</label>
            <input class="goal_setting__input" type="number" name="goal_weight" id="goal_weight" value="{{ old('goal_weight', $user->goal_weight) }}" step="0.1"> kg
            @error('goal_weight')
            <p class="goal_setting__error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="button-content">
            <a href="{{ route('weight_logs.index') }}" class="back">戻る</a>
            <button type="submit" class="button-change">更新</button>
        </div>
    </form>
</div>

@endsection