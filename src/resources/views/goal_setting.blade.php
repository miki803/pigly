@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}">
@endsection

@section('content')

<div class="goal_setting__inner">
    <div class="goal_setting__card">
        <h2 class="goal-title">目標体重設定</h2>
        <form action="{{ route('weight_logs.goal.update') }}" method="post">
            @csrf
            @method('PATCH')

            <div class="goal_setting__group">
                <input class="goal_setting__input" type="number" name="goal_weight" id="goal_weight" value="{{ old('goal_weight', $goal->target_weight ?? '') }}" step="0.1"> kg
                <p class="goal_setting__error-message">
                    @error('goal_weight')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="button-content">
                <a class="button-back" href="{{ route('weight_logs.index') }}" >戻る</a>
                <button class="button-update" type="submit">更新</button>
            </div>
        </form>
    </div>
</div>

@endsection