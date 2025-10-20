@extends('layouts/app')


@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_log.css')}}">
@endsection


@endsection

@section('content')
<form class="data-form" action="/weight_logs/data" method="get">
  @csrf

  <div class="data-form__group">
    <p>Weight Log</p>


          <div class="data-form__group">
            <label class="data-form__label">日付</label>
            <p>{{ $log->date }}</p>
            @error('product_date')
                <span class="data_error">
                    <p class="data_error_message">{{$errors->first('product_date')}}</p>
                </span>
            @enderror
          </div>

          <div class="data-form__group">
            <label class="data-form__label">体重</label>
            <p>{{ $log->weight }} kg</p>
            @error('product_weight')
                <span class="data_error">
                    <p class="data_error_message">{{$errors->first('product_weight')}}</p>
                </span>
            @enderror
          </div>

          <div class="data-form__group">
            <label class="data-form__label">摂取カロリー</label>
            <p>{{ $log->calories }} kcal</p>
            @error('product_calories')
                <span class="data_error">
                    <p class="data_error_message">{{$errors->first('product_calories')}}</p>
                </span>
            @enderror
          </div>

          <div class="data-form__group">
            <label class="data-form__label">運動時間</label>
            <p>{{ $log->exercise_time }} 分</p>
            @error('product_exercise_time')
                <span class="data_error">
                    <p class="data_error_message">{{$errors->first('product_exercise_time')}}</p>
                </span>
            @enderror
          </div>

          <div class="data-form__group">
            <label class="data-form__label">運動内容</label>
            <textarea>{{ $log->exercise_detail }}</textarea>
            @error('product_exercise_detail')
                <span class="datat_error">
                    <p class="data_error_message">{{$errors->first('product_exercise_detail')}}</p>
                </span>
            @enderror
          </div>

          <form action="/weight_logs/{{ $log->id }}/delete" method="post">
            @csrf
            <a href="/products" class="back">戻る</a>
            <button type="submit" class="button-register">登録</button>
          </form>

        </div>
      </div>
      <a href="#" class="data__close-btn">×</a>
    </div>
  </div>
  @endforeach
</table>