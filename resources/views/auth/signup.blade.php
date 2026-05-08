@extends('layouts.app')

@section('title', '新規作成ページ')

@section('content')
<h2>新規作成</h2>
<form method="POST" action=" {{ route('signup.store') }} ">
    @csrf
    <div>
        <label for="name">ニックネーム</label>
        <input id="name" type="text" name="name">
    </div>


    <div>
        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email">
    </div>
    @error('email')
    <p style="color: red; font-size: 14px;">
        {{ $message }}
    </p>
    @enderror

    <div>
        <label for="password">パスワード</label>
        <input id="password" type="password" name="password">
    </div>

    <div>
        <label for="confirm">パスワード(確認)</label>
        <input id="confirm" type="password" name="password_confirmation">

        @error('password')
        <p style="color: red; font-size: 14px;">
            {{ $message }}
        </p>
        @enderror
    </div>

    <button type="submit">作成</button>
</form>

<form method="GET" action="{{ route('login') }}">
    <button type="submit">ログインに戻る</button>
</form>

@endsection