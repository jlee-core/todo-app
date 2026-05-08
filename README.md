# Todo App まとめ

## アプリ概要

Laravel + MySQL を使用して開発した簡易なTodo管理アプリです。  
ユーザー登録・ログイン機能を備え、ログインユーザーごとに Todo を作成・管理できます。

個人ごとのタスクを安全に管理できるように、認証機能・セッション管理・ユーザーごとのデータ分離を意識して実装しました。

---

## 主な機能

- ユーザー新規登録
- ログイン / ログアウト
- Todo 作成
- Todo 一覧表示
- Todo 編集
- Todo 削除
- Todo 完了 / 未完了切り替え
- Todo 検索（タイトル部分一致）
- Todo 並び替え（created_at 順）
- 添付ファイルアップロード
- 画像ファイルプレビュー表示
- 添付ファイルダウンロード
- バリデーションエラー表示
- セッション認証

---

## 画面構成

### 認証系

- ログイン画面
- 新規登録画面

### Todo系

- Todo 一覧画面
- Todo 作成画面
- Todo 編集画面
- Todo 検索結果画面

### 共通レイアウト

- ヘッダー
    - ログインユーザー名表示
    - ログアウトボタン
- ナビゲーション

---

## DB設計

## users

| カラム名 | 型 | 備考 |
|---|---|---|
| id | uuid | 主キー |
| name | varchar | ユーザー名 |
| email | varchar | unique |
| password | varchar | ハッシュ保存 |
| created_at | timestamp | |
| updated_at | timestamp | |

---

## todos

| カラム名 | 型 | 備考 |
|---|---|---|
| id | bigint | 主キー |
| user_id | uuid | users.id 外部キー |
| title | varchar | Todoタイトル |
| body | text | 内容 |
| is_done | tinyint(1) | 完了フラグ |
| attachment_path | varchar | 添付ファイルパス |
| created_at | timestamp | |
| updated_at | timestamp | |

---

## sessions

| カラム名 | 型 | 備考 |
|---|---|---|
| id | string | セッションID |
| user_id | uuid | users.id |
| ip_address | varchar | |
| user_agent | text | |
| payload | longText | |
| last_activity | int | |

---

## 認証・認可の方針

### 認証

Laravel 標準セッション認証を利用。

- `Auth::attempt()`
- `Auth::user()`
- `auth middleware`

### 認可

ログインユーザー本人の Todo のみ操作可能。

```php
Todo::where('user_id', Auth::id())