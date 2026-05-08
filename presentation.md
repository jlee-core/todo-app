# 新たな実装機能

- ユーザー新規作成機能
- パスワード確認入力機能（確認用パスワードバリデーション）
- Search結果一覧の並び替え機能（created_at順）
- usersテーブルの主キー `id` を UUID へ変更

---

# 課題・対応内容

## ① users.id を UUID に変更した際、関連テーブルの user_id 型不一致で認証エラー発生

### 課題
`users.id` を UUID（string）へ変更したが、外部キーとして利用している `sessions.user_id` と `todos.user_id` が bigint のままだったため、認証やリレーション取得が正常に動作しなかった。

### 対応
関連テーブルの `user_id` カラムも UUID(string) 型へ変更し、`users.id` と型を統一した。

---

## ② ログインユーザー情報を複数画面で表示する際、毎回 Controller から view に渡してしまいコード重複

### 課題
各Controllerで毎回 `user` を `view()` に渡す必要があり、同じ記述が増えてしまった。

### 対応
`AppServiceProvider` の `boot()` 内で、親レイアウトビューへ `Auth::user()` を共有し、全画面で共通利用できるようにした。

---

## ③ search機能が正常動作しない

### 課題
`Route::resource('todos', TodoController::class)` の後に `todos/search` を定義していたため、Laravel が `/todos/search` を `/todos/{todo}` と解釈し、resource の `show()` へルーティングしてしまった。

### 対応
`php artisan route:list`でルートを確認し、上記の`/todos/search` を `/todos/{todo}` と解釈したことを判明し、`todos/search` のルート定義を `resource` より前に移動し、正しく `search()` が呼ばれるよう修正した。

---

# 学んだこと

- テーブル設計変更時は、関連テーブルの外部キー型まで含めて整合性を確認することが重要。
- Laravel の認証・リレーションは DB構造と密接に関係しているため、MySQL設計との整合性理解が必要。
- Route定義は記述順によって挙動が変わるため、resource route 使用時は競合に注意すること。
- 共通データは `AppServiceProvider` や View共有機能を活用するとコード重複を防げる。