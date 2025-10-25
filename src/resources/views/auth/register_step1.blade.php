<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/auth/register_step1.css')}}">
    <title>PiGly</title>
</head>
<body>
    <div class="register-form">
        <h1 class="register-form__logo">PiGLy</h1>
        <h2 class="register-form__title">新規会員登録</h2>
        <p class="register-form__step">STEP1 アカウント情報の登録</p>

        <form class="register-form__form" action="{{ route('register.step1') }}" method="post">
            @csrf
            <div class="register-form__group">
                <label class="register-form__label" for="name">お名前</label>
                <input class="register-form__input" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="名前を入力">
                <p class="register-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="email">メールアドレス</label>
                <input class="register-form__input" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
                <p class="register-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="password">パスワード</label>
                <input class="register-form__input" type="password" name="password" id="password" placeholder="パスワードを入力">
                <p class="register-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <button class="register-form__btn" type="submit" >次に進む</button>
            <a  class="register__link" href="{{ route('login') }}" class="login-link">ログインはこちら</a>
        </form>
    </div>
</body>
</html>