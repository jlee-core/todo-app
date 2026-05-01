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
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>© Todo App</p>
    </footer>
</body>

</html>