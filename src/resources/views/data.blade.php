@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/data.css')}}">
@endsection

@section('content')
<div class="main">
  <div class="data-form__inner">
    <h2 class="data-title">Weight Log</h2>

    <form action="{{ route('weight_logs.update', $weightLog->id) }}" method="post">
      @csrf
      @method('PATCH')


      <div class="data-form__group">
        <label class="data-label">日付</label>
        <input class="data-input" type="date" name="date" value="{{ old('date', $weightLog->date) }}">
        @error('date')
          <p class="data_error_message">{{ $message }}</p>
        @enderror
      </div>

      <div class="data-form__group unit-input">
        <label class="data-label">体重</label>
        <div class="unit-field">
          <input class="data-input" type="number" name="weight" value="{{ old('weight', $weightLog->weight) }}" step="0.1">
          <span class="unit">kg</span>
        </div>
        @error('weight')
          <p class="data_error_message">{{ $message }}</p>
        @enderror
      </div>

      <div class="data-form__group unit-input">
        <label class="data-label">摂取カロリー</label>
        <div class="unit-field">
          <input class="data-input" type="number" name="calories" value="{{ old('calories', $weightLog->calories) }}">
          <span class="unit">kcal</span>
        </div>
        @error('calories')
          <p class="data_error_message">{{ $message }}</p>
        @enderror
      </div>

      <div class="data-form__group">
        <label class="data-label">運動時間</label>
        <input class="data-input" type="time" name="exercise_time" value="{{ old('exercise_time', $weightLog->exercise_time) }}">
        @error('exercise_time')
          <p class="data_error_message">{{ $message }}</p>
        @enderror
      </div>

      <div class="data-form__group">
        <label class="data-label">運動内容</label>
        <textarea class="data-input" name="exercise_detail" placeholder="運動内容を追加">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
        @error('exercise_detail')
          <p class="data_error_message">{{ $message }}</p>
        @enderror
      </div>

      <div class="data-form__buttons">
        <a class="data-back" href="{{ route('weight_logs.index') }}">戻る</a>
        <button class="data-update" type="submit">更新</button>
      </div>
    </form>

    <form action="{{ url('weight_logs/' . $weightLog->id . '/delete') }}" method="POST" class="delete-form-inline">
      @csrf
      @method('DELETE')
      <button class="button-delete" type="submit">
        <img src="{{ asset('images/ゴミ箱.png') }}" alt="削除" class="trash-icon">
      </button>
    </form>
  </div>
</div>
@endsection