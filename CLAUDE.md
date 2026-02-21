# CLAUDE.md - MoneyBoard User

このファイルはClaude Codeがプロジェクトを理解するためのガイドです。

## プロジェクト概要

MoneyBoard Userは、B2B決済サービス「マネーボード」のユーザー向けフロントエンド＆バックエンド統合型SPAです。
ユーザー登録、ログイン、決済（Stripe連携）、マイページ管理などの機能を提供します。

## 技術スタック

### バックエンド
- **フレームワーク**: Laravel 7.x (PHP 7.2.5+/8.0)
- **認証**: JWT (tymon/jwt-auth v1.0)
- **決済**: Stripe (Laravel Cashier v10.6)
- **HTTPクライアント**: Guzzle

### フロントエンド
- **フレームワーク**: Vue.js 3.1.5
- **ルーティング**: Vue Router 4.0.10
- **状態管理**: Vuex 4.0.2 (persistedState)
- **バリデーション**: Vuelidate 2.0
- **ビルドツール**: Laravel Mix 6.0.27 + Webpack
- **HTTP通信**: Axios
- **スタイル**: SCSS

## ディレクトリ構造

```
moneyboard-user/
├── app/                          # Laravelバックエンド
│   ├── Http/
│   │   ├── Controllers/          # コントローラ（13個）
│   │   │   ├── Auth/             # 認証関連
│   │   │   ├── LoginController.php
│   │   │   ├── RegistrationController.php
│   │   │   ├── StripePaymentsController.php
│   │   │   └── ValidationsController.php
│   │   └── Middleware/           # ミドルウェア（8個）
│   ├── User.php                  # ユーザーモデル
│   └── Payment.php               # Stripe連携モデル
├── routes/
│   ├── web.php                   # Webルート（SPA用）
│   └── api.php                   # APIルート
├── resources/
│   ├── js/                       # Vue.jsフロントエンド
│   │   ├── app.js                # エントリーポイント
│   │   ├── App.vue               # ルートコンポーネント
│   │   ├── routes.js             # Vue Router定義
│   │   ├── components/           # 共通コンポーネント（7個）
│   │   ├── views/                # ページコンポーネント（59個）
│   │   │   ├── Home.vue          # ランディングページ
│   │   │   ├── Login.vue         # ログイン
│   │   │   ├── Signup.vue        # 登録
│   │   │   └── mypage/           # マイページ関連
│   │   ├── store/                # Vuexストア
│   │   │   └── modules/
│   │   │       ├── auth.js       # 認証モジュール
│   │   │       └── error.js      # エラーモジュール
│   │   └── customValidators/     # カスタムバリデータ
│   ├── sass/                     # SCSS
│   └── views/
│       └── app.blade.php         # SPAテンプレート
├── config/                       # Laravel設定
├── database/migrations/          # マイグレーション
├── tests/                        # テスト
├── public/                       # 公開ディレクトリ
├── docker-compose.yml            # Docker設定
└── webpack.mix.js                # ビルド設定
```

## 開発コマンド

### フロントエンド
```bash
npm install                # 依存関係インストール
npm run dev                # 開発ビルド
npm run watch              # ファイル変更監視ビルド
npm run hot                # ホットリロード
npm run prod               # 本番ビルド
```

### バックエンド
```bash
composer install           # 依存関係インストール
php artisan serve          # ローカルサーバ起動
php artisan migrate        # マイグレーション実行
php artisan cache:clear    # キャッシュクリア
php artisan jwt-auth:secret # JWT秘密鍵生成
```

### テスト
```bash
php artisan test           # 全テスト実行
php artisan test tests/Unit     # ユニットテストのみ
php artisan test tests/Feature  # 機能テストのみ
```

### Docker環境
```bash
docker-compose up -d       # コンテナ起動
docker-compose exec web bash  # シェルアクセス
# ポート: web=80, mysql=3306, mailhog=8025, phpmyadmin=8081
```

## アーキテクチャ

### バックエンド: MVC + RESTful API
```
Request → Route → Middleware → Controller → Model → Database
```

### フロントエンド: SPA (Vue.js 3)
```
Component → Vuex Action → Axios → API → Store Mutation → Re-render
```

### 認証フロー
- JWT (JSON Web Token) ベース認証
- LocalStorageにトークン・有効期限を保存
- ナビゲーションガードでトークン有効期限チェック
- 自動リフレッシュ機能あり

### 状態管理 (Vuex)
- `auth`: ユーザー・カード・会社情報
- `error`: エラーハンドリング
- SessionStorageで永続化

## コーディング規約

### PHP (Laravel)
- PSR-4 オートロード
- PSR-2 コーディング規約
- namespace使用

### Vue.js / JavaScript
- ES6+ モダンJavaScript
- Vue 3 Options API（一部Composition API）
- Single File Components (.vue)
- コンポーネント命名: PascalCase (`HeaderComponent.vue`)
- 変数命名: camelCase

### ファイル配置
- 再利用コンポーネント → `resources/js/components/`
- ページコンポーネント → `resources/js/views/`
- Vuexモジュール → `resources/js/store/modules/`

## 環境変数

主要な環境変数（`.env`で設定）:
```
APP_ENV=local/production
APP_URL=http://localhost
DB_CONNECTION=mysql
MIX_VUE_APP_API_URL=          # バックエンドAPIのURL
MIX_VUE_APP_STRIPE_PUBLIC_KEY= # Stripe公開キー
CASHIER_CURRENCY=jpy
```

## 主要機能

- **ユーザー管理**: 登録、ログイン、パスワード再発行/変更
- **決済管理**: クレジットカード登録、Stripe統合、プラン管理
- **マイページ**: 登録情報変更、会社情報、カード情報、担当者管理
- **その他**: 利用規約、プライバシーポリシー、お問い合わせ

## 注意事項

- フロントエンドのlint/formatter設定がないため、コードスタイルに注意
- APIのベースURLは`MIX_VUE_APP_API_URL`環境変数で設定
- Stripe決済のテストはテスト用APIキーを使用
- JWT認証トークンの有効期限管理に注意
