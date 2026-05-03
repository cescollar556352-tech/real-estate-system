#!/bin/bash
chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache
php artisan config:cache
php artisan migrate --force
apache2-foreground