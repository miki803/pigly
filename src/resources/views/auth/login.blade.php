<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/auth/login.css')}}">
    <title>PiGly</title>
</head>
<body>
    <div class="login-form">
        <h1 class="login-form__logo">PiGLy</h1>
        <h2 class="login-form__title">ログイン</h2>


        <div class="login-form__inner">
            <form class="login-form__form" action="{{ route('login') }}" method="post">
                @csrf

                <div class="login-form__group">
                    <label class="login-form__label" for="email">メールアドレス</label>
                    <input class="login-form__input" type="email" name="email" id="email"  value="{{ old('email') }}"placeholder="メールアドレスを入力">
                    <p class="login-form__error-message">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="login-form__group">
                    <label class="login-form__label" for="password">パスワード</label>
                    <input class="login-form__input" type="password" name="password" id="password" placeholder="パスワードを入力">
                    <p class="login-form__error-message">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <button class="login-form__btn btn" type="submit" >ログイン</button>
                <a class="login__link" href="{{ route('register.step1') }}">アカウントの作成はこちら</a>
            </form>
        </div>
    </div>
</body>
</html>