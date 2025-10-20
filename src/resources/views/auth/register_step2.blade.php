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
        <h1 class="register-form__heading">PiGLy</h1>
        <h2 class="register-form__heading">新規会員登録</h2>
        <p class="register-form__subtext">STEP2 体重データの入力</p>

        <div class="register-form__inner">
            <form class="register-form__form" action="{{ route('register.step2') }}" method="post">
                @csrf
                <div class="register-form__group">
                    <label class="register-form__label" for="weight">現在の体重</label>
                    <input class="register-form__input" type="number" name="weight" id="weight" placeholder="現在の体重を入力">kg
                    <p class="register-form__error-message">
                        @error('weight')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="register-form__group">
                    <label class="register-form__label" for="weight">目標の体重</label>
                    <input class="register-form__input" type="number" name="goal_weight" id="goal_weight" placeholder="目標の体重を入力">kg
                    <p class="register-form__error-message">
                        @error('weight')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <input class="register-form__btn btn" type="submit" value="アカウント作成">
            </form>
        </div>
    </div>
</body>
</html>