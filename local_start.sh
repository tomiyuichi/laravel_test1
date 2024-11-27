#!/bin/bash
# 初期化コマンド
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan view:clear
# php artisan storage:link #  ERROR  The [public/storage] link already exists.
php artisan optimize
php artisan vendor:publish --tag=public --force

# Laravelアプリを起動
# php -S 0.0.0.0:8080 -t public
php artisan serve