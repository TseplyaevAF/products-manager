@echo off

php artisan config:cache
php artisan view:cache
php artisan route:cache