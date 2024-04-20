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
        <h1><a href="{{ route('post.index') }}" class="app-title">Laravelgram</a></h1>
    </header>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
    @yield('script')
</body>
</html>
