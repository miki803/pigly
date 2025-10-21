<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pigly</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>
    <div class="app">
        <header class="header">
            <h1 class="header__logo">PiGLy</h1>

            <div class="header__left">
                <a class="header__btn" href="{{ route('goal.edit') }}">
                    <img src="{{ asset('images/goal-icon.png') }}" alt="目標体重設定アイコン" class="header__icon">
                    目標体重設定
                </a>
                <a class="header__btn" href="{{ route('logout') }}">
                    <img src="{{ asset('images/logout-icon.png') }}" alt="ログアウトアイコン" class="header__icon">
                    ログアウト
                </a>
            </div>

        </header>

        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>