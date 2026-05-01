@extends('layouts.app')

@section('title', 'ログインページ')

@section('content')
<h2>ログイン</h2>

<form method="POST" action="{{ route('login.store') }}">
    @csrf

    <div>
        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}">

        @error('email')
        <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password">パスワード</label>
        <input id="password" type="password" name="password">

        @error('password')
        <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">ログイン</button>

</form>

<form method="GET" action=" {{ route('signup') }} ">
    <button type="submit">新規作成</button>
</form>
@endsection