# Vue.js 起動ガイド - MoneyBoard User

## 🚀 クイックスタート（Docker使用 - 推奨）

### 前提条件
- Docker Desktop がインストールされていること

### 起動手順

```bash
# 1. Dockerコンテナを起動
docker-compose up -d

# 2. コンテナ内で依存関係をインストール
docker-compose exec web npm install
docker-compose exec web composer install

# 3. 環境設定（初回のみ）
cp .env_sample .env
docker-compose exec web php artisan key:generate
docker-compose exec web php artisan jwt:secret

# 4. データベースマイグレーション（初回のみ）
docker-compose exec web php artisan migrate

# 5. Vue.jsのビルド開始（ファイル変更を監視）
docker-compose exec web npm run watch
```

### アクセスURL
- **アプリケーション**: http://localhost
- **phpMyAdmin**: http://localhost:8081
- **MailHog（メール確認）**: http://localhost:8025

### コンテナの停止
```bash
docker-compose down
```

---

## 🖥️ ローカル環境での起動（上級者向け）

### 前提条件
- Node.js 14以上
- PHP 7.2.5以上（8.0推奨）
- MySQL 5.7以上
- Composer

### セットアップ

#### 1. PHPのインストール（macOSの場合）
```bash
# Homebrewを使用
brew install php@8.0
brew install composer
```

#### 2. MySQLのインストール
```bash
brew install mysql@5.7
brew services start mysql@5.7
```

#### 3. 依存関係のインストール
```bash
# フロントエンド
npm install

# バックエンド
composer install
```

#### 4. 環境設定
```bash
# .envファイルを作成
cp .env_sample .env

# .envファイルを編集してDB情報を設定
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=moneyboard
# DB_USERNAME=root
# DB_PASSWORD=

# アプリケーションキー生成
php artisan key:generate

# JWT秘密鍵生成
php artisan jwt:secret
```

#### 5. データベース作成
```bash
mysql -u root -p
```
```sql
CREATE DATABASE moneyboard CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

#### 6. マイグレーション実行
```bash
php artisan migrate
```

#### 7. アプリケーション起動

**ターミナル1: Laravelサーバ起動**
```bash
php artisan serve
# → http://localhost:8000 で起動
```

**ターミナル2: Vue.jsビルド監視**
```bash
npm run watch
# または
npm run hot  # ホットリロード有効
```

---

## 📝 開発コマンド一覧

### フロントエンド（Vue.js）

| コマンド | 説明 |
|---------|------|
| `npm run dev` | 1回だけビルド（開発モード） |
| `npm run watch` | ファイル変更を監視して自動ビルド |
| `npm run hot` | ホットモジュール置換（HMR）でビルド |
| `npm run prod` | 本番用に最適化してビルド |

### バックエンド（Laravel）

| コマンド | 説明 |
|---------|------|
| `php artisan serve` | 開発サーバ起動（http://localhost:8000） |
| `php artisan migrate` | データベースマイグレーション |
| `php artisan migrate:fresh` | データベースをリセットして再マイグレーション |
| `php artisan cache:clear` | キャッシュクリア |
| `php artisan config:clear` | 設定キャッシュクリア |
| `php artisan route:list` | 全ルート一覧表示 |
| `php artisan tinker` | 対話型シェル起動 |

---

## 🔧 トラブルシューティング

### エラー: `npm ERR! missing script: watch`
```bash
# package.jsonがあることを確認
cat package.json

# node_modulesを削除して再インストール
rm -rf node_modules
npm install
```

### エラー: `Class 'App\...' not found`
```bash
# Composerオートロードを再生成
composer dump-autoload
```

### エラー: `.env file not found`
```bash
# .envファイルを作成
cp .env_sample .env
php artisan key:generate
```

### ビルドファイルが更新されない
```bash
# public/js と public/css を削除
rm -rf public/js public/css

# キャッシュをクリア
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# 再ビルド
npm run dev
```

### Dockerコンテナが起動しない
```bash
# コンテナのログを確認
docker-compose logs

# コンテナを完全に削除して再起動
docker-compose down -v
docker-compose up -d --build
```

---

## 📂 重要なファイル・ディレクトリ

### Vue.js関連
- `resources/js/app.js` - エントリーポイント
- `resources/js/App.vue` - ルートコンポーネント
- `resources/js/routes.js` - ルート定義
- `resources/js/components/` - 共通コンポーネント
- `resources/js/views/` - ページコンポーネント
- `resources/js/store/` - Vuexストア

### ビルド設定
- `webpack.mix.js` - Laravel Mix設定
- `package.json` - npm依存関係
- `vue.config.js` - Vue開発サーバ設定

### Laravel関連
- `routes/web.php` - Webルート
- `routes/api.php` - APIルート
- `app/Http/Controllers/` - コントローラ
- `.env` - 環境変数

---

## 🎯 開発フロー

1. **Docker起動** → `docker-compose up -d`
2. **ビルド監視開始** → `npm run watch`（別ターミナル）
3. **コード編集** → `resources/js/` 内のVueファイルを編集
4. **ブラウザ確認** → http://localhost で自動反映を確認
5. **API変更時** → `app/Http/Controllers/` を編集（自動反映）
6. **DB変更時** → マイグレーションファイル作成 → `php artisan migrate`

---

## 💡 Vue.js 初心者向けTips

### ファイル構成の理解
```
resources/js/
├── app.js              ← ここでVue/Router/Storeを初期化
├── App.vue             ← 全ページ共通のレイアウト
├── routes.js           ← URLとコンポーネントのマッピング
├── components/         ← ヘッダー・フッターなど再利用部品
└── views/              ← 各ページのコンポーネント
    ├── Home.vue        ← トップページ
    ├── Login.vue       ← ログインページ
    └── mypage/         ← マイページ関連
```

### よく使うVueファイルの構造
```vue
<template>
  <!-- HTMLテンプレート -->
  <div>
    <h1>{{ title }}</h1>
    <button @click="handleClick">クリック</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: 'タイトル'
    }
  },
  methods: {
    handleClick() {
      alert('クリックされました')
    }
  }
}
</script>

<style scoped>
/* このコンポーネント専用のCSS */
h1 {
  color: blue;
}
</style>
```

### APIとの通信（Axiosの使い方）
```javascript
// resources/js/views/Login.vue などで
import axios from 'axios'

methods: {
  async login() {
    try {
      const response = await axios.post('/api/login', {
        email: this.email,
        password: this.password
      })
      console.log(response.data)
    } catch (error) {
      console.error(error)
    }
  }
}
```

---

## 📚 参考リンク

- [Vue.js 3 公式ドキュメント](https://v3.ja.vuejs.org/)
- [Vue Router 4 ドキュメント](https://router.vuejs.org/)
- [Vuex 4 ドキュメント](https://vuex.vuejs.org/)
- [Laravel 7 ドキュメント](https://laravel.com/docs/7.x)
- [Laravel Mix ドキュメント](https://laravel-mix.com/)
