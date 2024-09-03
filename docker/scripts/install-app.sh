#!/bin/bash

composer install --no-interaction --no-plugins --no-scripts --prefer-dist
#chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod 775 -R /var/www/storage /var/www/database/database.sqlite

php artisan migrate
php artisan db:seed
php artisan key:generate

php artisan serve --host=0.0.0.0 --port=8000
