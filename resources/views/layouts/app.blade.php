<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/style.css')
    <title>@yield('title', 'Todoアプリ')</title>
</head>

<body>
    <header>
        <h1>Todoアプリ</h1>
        @if(auth()->check())
        <h2>こんにちは、{{ $user->name; }}さん</h2>
        @endif
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>© Todo App</p>
    </footer>
</body>

</html>