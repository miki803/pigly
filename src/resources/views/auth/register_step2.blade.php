<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/auth/register_step2.css')}}">
    <title>PiGly</title>
</head>
<body>
    <div class="register-form">
        <h1 class="register-form__logo">PiGLy</h1>
        <h2 class="register-form__title">新規会員登録</h2>
        <p class="register-form__step">STEP2 体重データの入力</p>

        <div class="register-form__inner">
            <form class="register-form__form" action="{{ route('register.step2') }}" method="post">
                @csrf
                <div class="register-form__group">
                    <label class="register-form__label" for="weight">現在の体重</label>
                    <input class="register-form__input" type="number" name="current_weight" id="weight" step="0.1" value="{{ old('current_weight') }}" placeholder="現在の体重を入力">
                    <span class="register-form__unit">kg</span>
                    <p class="register-form__error-message">
                        @error('latest_weight')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="register-form__group">
                    <label class="register-form__label" for="weight">目標の体重</label>
                    <input class="register-form__input" type="number" name="goal_weight" id="goal_weight" step="0.1" value="{{ old('goal_weight') }}" placeholder="目標の体重を入力">
                    <span class="register-form__unit">kg</span>
                    <p class="register-form__error-message">
                        @error('goal_weight')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <button class="register-form__btn btn" type="submit">アカウント作成</button>
            </form>
        </div>
    </div>
</body>
</html>