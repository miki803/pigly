<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>
    <div class="app">
        <header class="header">
            <h1 class="header__logo">PiGLy</h1>

            <div class="header__right">
                <a class="header__btn" href="{{ route('weight_logs.goal.edit') }}">
                    <img src="{{ asset('images/歯車.png') }}" alt="目標体重設定アイコン" class="header__icon">
                    目標体重設定
                </a> 

                <form class="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="header__btn logout-btn">
                        <img src="{{ asset('images/戻る.png') }}" alt="ログアウトアイコン" class="header__icon">
                        ログアウト
                    </button>
                </form>
            </div>
        </header>

        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>