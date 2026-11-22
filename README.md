# laravel-student-app

学生の情報（学籍番号・氏名・学年・クラス・写真など）を登録・検索・編集できる、学生名簿管理の Web アプリです。

> 🚧 **開発中です。** 機能や画面は今後変わる予定です。

## 使用技術

- Laravel 12
- PHP 8.4
- MySQL 8.3
- Docker / Docker Compose

## 起動手順

Docker と Docker Compose が使える環境を前提にしています。

### 1. 環境変数を設定する

```bash
git clone https://github.com/yu-pakku/laravel-student-app.git
cd laravel-student-app

# Docker Compose 用（MySQL の root パスワード）
cp .env.example .env
# .env を開いて DB_ROOT_PASSWORD を設定してください

# Laravel 用
cp laravel_app/.env.example laravel_app/.env
# laravel_app/.env を開いて DB_PASSWORD に DB_ROOT_PASSWORD と同じ値を設定してください
```

### 2. 依存パッケージのインストールとアプリキーの生成

初回だけ実行します。app コンテナは `vendor/` がないと起動しないため、`up` の前に `run` で実行します。

```bash
docker compose run --rm app composer install
docker compose run --rm app php artisan key:generate
```

### 3. コンテナを起動してマイグレーションする

```bash
docker compose up -d
docker compose exec app php artisan storage:link
docker compose exec app php artisan migrate
```

MySQL は初めて起動するときに初期化処理があるため、すぐに `migrate` すると接続エラーになることがあります。その場合は数秒待ってから、もう一度実行してください。

### 4. アクセスする

ブラウザで次の URL を開いてください。

- 学生一覧: <http://localhost:8000/students>

停止するときは `docker compose down` を実行します。
