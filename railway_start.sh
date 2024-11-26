#!/bin/bash
# 初期化コマンド
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan view:clear

# Laravelアプリを起動
php -S 0.0.0.0:8080 -t public

