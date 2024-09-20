<div id="top"></div>

## 使用技術一覧

<p style="display: inline">
  <!-- フロントエンドのフレームワーク一覧 -->
  
  <!-- フロントエンドの言語一覧 -->
  <img src="https://img.shields.io/badge/-Javascript-F7DF1E.svg?logo=javascript&style=for-the-badge">
  <!-- バックエンドのフレームワーク一覧 -->
  <img src="https://img.shields.io/badge/-Laravel-E74430.svg?logo=laravel&style=for-the-badge">
  <!-- バックエンドの言語一覧 -->
  <img src="https://img.shields.io/badge/-Php-777BB4.svg?logo=php&style=for-the-badge">
  <!-- ミドルウェア一覧 -->
  <img src="https://img.shields.io/badge/-Nginx-269539.svg?logo=nginx&style=for-the-badge">
  <img src="https://img.shields.io/badge/-Mysql-4479A1.svg?logo=mysql&style=for-the-badge">
  <!-- インフラ一覧 -->
  <img src="https://img.shields.io/badge/-Docker-1488C6.svg?logo=docker&style=for-the-badge">
</p>

## 目次

1. [サービスについて](#サービスについて)
2. [環境](#環境)
3. [開発環境構築](#開発環境構築)
4. [URL](#URL)
5. [ログイン情報](#ログイン情報)
6. [ER図](#ER図)

## サービスについて

<!-- プロジェクトの概要を記載 -->
### サービス名：mogitate
### 概要：
当サービスは、商品の情報を効率的に管理できるプラットフォームです。  
ユーザーは新しい商品を簡単に登録し、既存の商品を検索・変更・削除することができます。

### 主な機能：
1. 商品登録  
    商品名、価格、季節、説明、画像を設定できます。

2. 商品検索  
    キーワードを使用した検索機能で商品を探すことができます。  
    また、検索結果のソート機能も備えております。

3. 商品変更  
    登録した商品の情報を簡単に変更することができます。

4. 商品削除  
    登録した商品の情報を簡単に削除することができます。

![top](https://github.com/user-attachments/assets/6324f7ae-41cf-4e16-93d8-440bb38585ca)

## 環境

<!-- 言語、フレームワーク、ミドルウェア、インフラの一覧とバージョンを記載 -->

| 言語・フレームワーク    | バージョン  |
| --------------------- | ---------- |
| PHP                   | 7.4.9      |
| Laravel               | 8.83.8     |
| nginx                 | 1.21.1     |
| MySQL                 | 8.0.26     |

## 開発環境構築

<!-- コンテナの作成方法、パッケージのインストール方法など、開発環境構築に必要な情報を記載 -->

### Dockerビルド
1. git clone git@github.com:HayatoOhki/mogitate.git
2. cd mogitate
3. docker-compose up -d --build

※MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.yml ファイルを編集してください。

### Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. cp env/.env.dev .env
4. php artisan key:generate
5. php artisan migrate --seed  
※上記のコマンドを実行しても「Nothing to migrate.」が返ってくる場合は以下のコマンドを実行してください。  
※既にテーブル内にデータが入っている場合は、それらが消えてしまうため注意してください。
6. php artisan migrate:fresh --seed
7. php artisan storage:link
8. cp -r src/public/images src/storage/app/public/images  
※商品を削除した際は画像データも同時に削除されるようになっていますので、  
　ダミーデータを削除した際は再度上記コマンドを実行するようにしてください。


### 動作確認
http://localhost/products にアクセスできるか確認  
アクセスできたら成功

### コンテナの停止
以下のコマンドでコンテナを停止することができます  
docker-compose down

## URL
### 開発環境
・phpMyAdmin：http://localhost:8080/  
・トップページ：http://localhost/products  

## ER図
![index](https://github.com/user-attachments/assets/88576360-d3ba-4e1e-a3e0-6515a175158a)
