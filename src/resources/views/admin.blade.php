@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin__inner">

  <!-- 上部体重情報エリア -->
  <div class="weight-summary">
    <div class="weight-summary__item">
      <label>目標体重（kg）</label>
      <input type="text" class="weight-summary__input" value="{{ $goal_weight ?? '-' }}" readonly>
    </div>
    <div class="weight-summary__item">
      <label>最新体重（kg）</label>
      <input type="text" class="weight-summary__input" value="{{ $latest_weight ?? '-' }}" readonly>>
    </div>
    <div class="weight-summary__item">
      <label>残り（kg）</label>
      <input type="text" class="weight-summary__input" value="{{ isset($goal_weight, $latest_weight) ? $goal_weight - $latest_weight : '-' }}" readonly>
    </div>
  </div>

  <!-- 日付検索フォーム -->
  <form action="{{ route('weight_logs.search') }}" method="GET" class="search-form">
    <input type="date" name="start_date" value="{{ request('start_date') }}">
    <span>〜</span>
    <input type="date" name="end_date" value="{{ request('end_date') }}">
    <div class="search-form__actions">
      <button type="submit" class="search-form__btn">検索</button>
      @if(request('start_date') || request('end_date'))
        <a href="{{ route('weight_logs.index') }}" class="reset-btn">リセット</a>
      @endif
      <a href="{{ route('weight_logs.create') }}" class="add-btn">データ追加</a>
    </div>
  </form>

  <!-- テーブル -->
  <table class="admin__table">
    <tr class="admin__row">
      <th class="admin__label">日付</th>
      <th class="admin__label">体重（kg）</th>
      <th class="admin__label">摂取カロリー（kcal）</th>
      <th class="admin__label">運動時間（分）</th>
      <th class="admin__label"></th>
    </tr>

    @foreach($weightLogs as $log)
    <tr class="admin__row">
      <td class="admin__data">{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
      <td class="admin__data">{{ $log->weight }} kg</td>
      <td class="admin__data">{{ $log->calories }} kcal</td>
      <td class="admin__data">{{ sprintf('%02d:%02d', floor($log->exercise_time / 60), $log->exercise_time % 60) }}</td>
      <td class="admin__data">
        <a class="admin__detail-btn" href="{{ route('weight_logs.show', $log->id) }}">詳細</a>
      </td>
    </tr>
    @endforeach
  </table>

  <!-- ページネーション -->
  <div class="pagination">
    {{ $weightLogs->appends(request()->query())->links() }}
  </div>

</div>

<!-- データ追加モーダル -->
<div class="modal" id="addDataModal">
  <a href="#!" class="modal-overlay"></a>
  <div class="modal__inner">
    <div class="modal__content">
      <h2>体重データ追加</h2>
      <form action="{{ route('data.store') }}" method="post">
        @csrf
        <div class="modal-form__group">
          <label>日付<span class="required">必須</span></label>
          <input type="date" name="date" required>
          @error('date')
            <span class="data_error_message">{{ $message }}</span>
          @enderror
        </div>
        <div class="modal-form__group">
          <label>体重<span class="required">必須</span></label>
          <input type="number" name="weight" step="0.1" required>
          @error('weight')
            <span class="data_error_message">{{ $message }}</span>
          @enderror
        </div>
        <div class="modal-form__group">
          <label>摂取カロリー<span class="required">必須</span></label>
          <input type="number" name="calories" required>
          @error('calories')
            <span class="data_error_message">{{ $message }}</span>
          @enderror
        </div>
        <div class="modal-form__group">
          <label>運動時間<span class="required">必須</span></label>
          <input type="number" name="exercise_time" required>
          @error('exercise_time')
            <span class="data_error_message">{{ $message }}</span>
          @enderror
        </div>
        <div class="modal-form__group">
          <label>運動内容</label>
          <textarea name="exercise_detail" rows="6"></textarea>
          @error('exercise_detail')
            <span class="data_error_message">{{ $message }}</span>
          @enderror
        </div>
        <div class="modal__buttons">
          <a href="#!" class="modal__btn modal__btn--close">戻る</a>
          <button type="submit" class="modal__btn modal__btn--save">登録</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection