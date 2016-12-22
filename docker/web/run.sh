#!/bin/bash

chown -R www-data:www-data /var/www/html/storage

n=0
until [ $n -ge 5 ]
do
    php artisan migrate && break  # substitute your command here
    n=$[$n+1]
    sleep 15
done

cd /var/www/html

if [ ! -f .env ]; then
    envsubst < ".env.example" > ".env"
fi

composer install
php artisan key:generate

exec apache2-foreground