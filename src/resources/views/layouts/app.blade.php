<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pigly</title>
    <link rel="stylesheet" href="" />
    <link rel="stylesheet" href="{{ asset('css/.css')}}">
    @yield('css')
</head>
<body>
    <div class="app">
        <header class="header">
            <h1 class="header_logo">PiGLy</h1>

            <a class="header__link" href="{{ route('goal.edit') }}">目標体重設定</a>
            <div class="trash-can-content">
                <a href="/products/">
                    <img src="{{ asset('/images') }}" alt="画像" class="img" />
                </a>
            </div>

            <a class="header__link" href="{{ route('logout') }}">ログアウト</a>
            <div class="trash-can-content">
                <a href="/products/">
                    <img src="{{ asset('/images') }}" alt="画像" class="img" />
                </a>
            </div>

            @yield('link')
        </header>
        <div class="content">
        @yield('content')
        </div>
    </div>
</body>
</html>
