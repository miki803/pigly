@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin__inner">

  <!-- ===================== 上部体重情報エリア ===================== -->
  <section class="summary">
    <div class="summary-weight">
      <p class="summary-label">目標体重</p>
      <p class="summary-value">{{ is_numeric($goal_weight) ? number_format($goal_weight, 1) : '-' }}<span>kg</span></p>
    </div>
    <div class="summary-weight">
      <p class="summary-label">目標まで</p>
      <p class="summary-value">
        @if(is_numeric($latest_weight) && is_numeric($goal_weight))
          {{ number_format($goal_weight - $latest_weight, 1) * -1 }}<span>kg</span>
        @else
          -
        @endif
      </p>
    </div>
    <div class="summary-weight">
      <p class="summary-label">最新体重</p>
      <p class="summary-value">{{ is_numeric($latest_weight) ? number_format($latest_weight, 1) : '-' }}<span>kg</span></p>
    </div>
  </section>

  <!-- ===================== 検索フォーム ===================== -->
  <section class="filter">
  <form class="filter-form" action="{{ route('weight_logs.index') }}" method="GET">
    <!-- 日付範囲 -->
    <div class="filter-date">
      <input class="filter-input" type="date" name="start_date" value="{{ request('start_date') }}">
      <span>〜</span>
      <input class="filter-input" type="date" name="end_date" value="{{ request('end_date') }}">
    </div>

    <!-- ボタン群 -->
    <div class="filter-actions">
      <button class="filter-form__btn" type="submit">検索</button>
      @if(request('start_date') || request('end_date'))
        <a class="reset-btn" href="{{ route('weight_logs.index') }}">リセット</a>
      @endif
      <a class="add-btn" href="#addDataModal">データ追加</a>
    </div>
  </form>

  @if (isset($start_date) && isset($end_date))
    <p class="filter__result">
      {{ $start_date }}〜{{ $end_date }} の検索結果 {{ $weightLogs->total() }}件
    </p>
  @endif
</section>


  <!-- ===================== テーブル ===================== -->
  <section class="table-area">
    <table class="admin__table">
      <thead>
        <tr>
          <th>日付</th>
          <th>体重</th>
          <th>摂取カロリー</th>
          <th>運動時間</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($weightLogs as $log)
        <tr>
          <td>{{  \Carbon\Carbon::parse($log->date)->format('Y/m/d')  }}</td>
          <td>{{ number_format($log->weight, 1) }}kg</td>
          <td>{{ $log->calories  }}kcal</td>
          <td>{{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i')  }}</td>
          <td>
            <a class="admin__detail-btn" href="{{ route('weight_logs.show', $log->id) }}">
              <img class="edit-icon" src="{{ asset('images/鉛筆.png') }}" alt="編集">
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </section>

  <!-- ===================== ページネーション ===================== -->
  <div class="pagination">
    {{ $weightLogs->appends(request()->query())->links() }}
  </div>

</div>

<!-- ===================== データ追加モーダル ===================== -->
<div class="modal" id="addDataModal">
  <a href="#!" class="modal-overlay"></a>
  <div class="modal__inner">
    <div class="modal__content">
      <h2 class="modal__title">Weight Logを追加</h2>
      <form action="{{ route('weight_logs.store') }}" method="post">
        @csrf
        <!-- 日付 -->
        <div class="modal__group">
          <label>日付 <span class="required">必須</span></label>
          <input type="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}">
          @error('date')
            <p class="data_error_message">{{ $message }}</p>
          @enderror
        </div>

        <!-- 体重 -->
        <div class="modal__group">
          <label>体重 <span class="required">必須</span></label>
          <input type="number" name="weight" step="0.1" value="{{ old('weight') }}">
          @error('weight')
            <p class="data_error_message">{{ $message }}</p>
          @enderror
        </div>

        <!-- 摂取カロリー -->
        <div class="modal__group">
          <label>摂取カロリー <span class="required">必須</span></label>
          <input type="number" name="calories" value="{{ old('calories') }}">
          @error('calories')
            <p class="data_error_message">{{ $message }}</p>
          @enderror
        </div>

        <!-- 運動時間 -->
        <div class="modal__group">
          <label>運動時間 <span class="required">必須</span></label>
          <input type="time" name="exercise_time" value="{{ old('exercise_time') }}">
          @error('exercise_time')
            <p class="data_error_message">{{ $message }}</p>
          @enderror
        </div>

        <!-- 運動内容 -->
        <div class="modal__group">
          <label>運動内容</label>
          <textarea name="exercise_detail" rows="4">{{ old('exercise_detail') }}</textarea>
          @error('exercise_detail')
            <p class="data_error_message">{{ $message }}</p>
          @enderror
        </div>

        <!-- ボタン -->
        <div class="modal__buttons">
          <a href="#!" class="modal__btn modal__btn--close">戻る</a>
          <button type="submit" class="modal__btn modal__btn--save">登録</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection