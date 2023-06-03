# personal-library-app

.envファイル作成

```shell
echo "Laravelディレクトリに移動"
cd src/laravel

echo "環境変数定義ファイルをコピー"
cat .env.example \
| sed s/WWWUSER=/WWWUSER=$(id -u)/ \
| sed s/WWWGROUP=/WWWGROUP=$(id -g)/ > .env
```

既存アプリケーションでComposer依存関係のインストール

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

Docker起動

```shell
cd src/laravel
docker-compose up -d
```

composerインストール

```shell
cd src/laravel
docker-compose exec app composer install
```

```shell
cd src/laravel
docker-compose exec app php artisan key:generate
```

マイグレーション実行

```shell
cd src/laravel
docker-compose exec app php artisan migrate
```

ide-helperファイルを作成

```shell
cd src/laravel
docker-compose exec app composer ide-helper
```
