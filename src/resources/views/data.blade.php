@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/data.css')}}">
@endsection

@section('content')
<div class="data-form__inner">
  <h2>Weight Log 編集</h2>

  <form action="{{ route('weight_logs.update', $log->id) }}" method="post">
    @csrf
    @method('PATCH')

    <div class="data-form__group">
      <label>日付<span class="required">必須</span></label>
      <input type="date" name="date" value="{{ old('date', $log->date) }}">
      @error('date')
        <span class="data_error_message">{{ $message }}</span>
      @enderror
    </div>

    <div class="data-form__group">
      <label>体重<span class="required">必須</span></label>
      <input type="number" name="weight" value="{{ old('weight', $log->weight) }}" step="0.1"> kg
      @error('weight')
        <span class="data_error_message">{{ $message }}</span>
      @enderror
    </div>

    <div class="data-form__group">
      <label>摂取カロリー<span class="required">必須</span></label>
      <input type="number" name="calories" value="{{ old('calories', $log->calories) }}"> kcal
      @error('calories')
        <span class="data_error_message">{{ $message }}</span>
      @enderror
    </div>

    <div class="data-form__group">
      <label>運動時間<span class="required">必須</span></label>
      <input type="number" name="exercise_time" value="{{ old('exercise_time', $log->exercise_time) }}">
      @error('exercise_time')
        <span class="data_error_message">{{ $message }}</span>
      @enderror
    </div>

    <div class="data-form__group">
      <label>運動内容</label>
      <textarea name="exercise_detail" rows="6">{{ old('exercise_detail', $log->exercise_detail) }}</textarea>
      @error('exercise_detail')
        <span class="data_error_message">{{ $message }}</span>
      @enderror
    </div>

    <div class="data-form__buttons">
      <a href="{{ route('admin.index') }}" class="back">戻る</a>
      <button type="submit" class="button-register">登録</button>
    </div>
  </form>

  <!-- 削除ボタンは別フォームで安全に -->
  <form action="{{ route('weight_logs.destroy', $log->id) }}" method="post" class="delete-form">
    @csrf
    @method('DELETE')
    <button type="submit" class="button-delete">
      <img src="{{ asset('images/trash-icon.png') }}" alt="削除" class="trash-icon">
    </button>
  </form>

</div>
@endsection