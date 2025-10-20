@extends('layouts/app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css')}}">
@endsection


@endsection

@section('content')
<form class="admin-form" action="/admin" method="get">
  @csrf

  <div class="admin-form__group">
    <label class="admin-form__label" for="goal_weight">目標体重（kg）</label>
    <input class="search-form__input" >
  </div>

  <div class="admin-form__group">
    <label class="admin-form__label" for="latest_weight">最新体重（kg）</label>
    <input class="search-form__input" >
  </div>

  <div class="admin-form__group">
    <label class="admin-form__label" for="weight_diff">残り（kg）</label>
    <input class="search-form__input">
  </div>

  <div class="admin-form__actions">
    <input class="admin-form__search-btn btn" type="submit" value="検索">
    <input class="admin-form__reset-btn btn" type="submit" value="リセット" name="reset">
  </div>
</form>

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
    <td class="admin__data">{{ $log->date }}</td>
    <td class="admin__data">{{ $log->weight }}</td>
    <td class="admin__data">{{ $log->calories }}</td>
    <td class="admin__data">{{ $log->exercise_time }}</td>
    <td class="admin__data">
      <a class="admin__detail-btn" href="#record{{ $log->id }}">詳細</a>
    </td>
  </tr>

  <!-- モーダル詳細 -->
  <div class="modal" id="record{{ $log->id }}">
    <a href="#!" class="modal-overlay"></a>
    <div class="modal__inner">
      <div class="modal__content">
        <div class="modal__detail-form">

          <div class="modal-form__group">
            <label class="modal-form__label">日付</label>
            <p>{{ $log->date }}</p>
          </div>

          <div class="modal-form__group">
            <label class="modal-form__label">体重</label>
            <p>{{ $log->weight }} kg</p>
          </div>

          <div class="modal-form__group">
            <label class="modal-form__label">摂取カロリー</label>
            <p>{{ $log->calories }} kcal</p>
          </div>

          <div class="modal-form__group">
            <label class="modal-form__label">運動時間</label>
            <p>{{ $log->exercise_time }} 分</p>
          </div>

          <div class="modal-form__group">
            <label class="modal-form__label">運動内容</label>
            <textarea>{{ $log->exercise_detail }}</textarea>
          </div>

          <form action="/weight_logs/{{ $log->id }}/delete" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $log->id }}">
            <input class="modal-form__delete-btn btn" type="submit" value="削除">
          </form>

        </div>
      </div>
      <a href="#" class="modal__close-btn">×</a>
    </div>
  </div>
  @endforeach
</table>