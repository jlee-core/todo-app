<!DOCTYPE html>
<html lang="ja">

<head>
    <title>編集ページ</title>
    <meta charset="UTF-8">
</head>

<body>
    <h4>Todoを編集</h4>
    <form action="{{ route('todos.update', $todo) }}" method="POST">

        <div>
            <label for="category_id">カテゴリ</label>

            <select id="category_id" name="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $todo->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>

            @error('category_id')
            <p>{{ $message }}</p>
            @enderror
        </div>

        @csrf
        @method('PUT')

        タイトル<br>
        <input type="text" name="title" value="{{ $todo->title }}"><br>
        内容<br>
        <textarea name="body">{{ $todo->body }}</textarea><br>

        <label>
            <input type="checkbox" name="is_done" value="1" @checked($todo->is_done)>
            完了済みにする
        </label><br>
        <button type="submit">更新</button>
    </form>
    <p>
        <a href="{{ route('todos.index') }}">一覧へ戻る</a>
    </p>
</body>

</html>