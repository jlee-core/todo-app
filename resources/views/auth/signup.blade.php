@extends('layouts.app')

@section('title', '新規作成ページ')

@section('content')
<h2>新規作成</h2>
<form method="POST" action=" {{ route('signup.store') }} ">
    <div>
    <label for="name">ニックネーム</label>
    <input id="name" type="text" name="name">
</div>

<div>
    <label for="email">メールアドレス</label>
    <input id="email" type="email" name="email">
</div>

<div>
    <label for="password">パスワード</label>
    <input id="password" type="password" name="password">
</div>

<button type="submit">作成</button>
</form>

<form method="GET" action="{{ route('login') }}">
    <button type="submit">ログインに戻る</button>
</form>

@endsection