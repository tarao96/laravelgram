<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>Larvelgram | @yield('title')</title>
</head>
<body>
    <header>
        <div class="spacer"></div>
        <h1><a href="{{ route('post.index') }}" class="app-title">Laravelgram</a></h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="logout-btn">ログアウト</button>
        </form>
    </header>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
    @yield('script')
</body>
</html>
