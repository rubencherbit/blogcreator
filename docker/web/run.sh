#!/bin/bash
mkdir /var/www/html/public/uploads
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/public/uploads

composer install

cd /var/www/html

if [ ! -f .env ]; then
    envsubst < ".env.example" > ".env"
fi

php artisan key:generate

n=0
until [ $n -ge 5 ]
do
    php artisan migrate && break  # substitute your command here
    n=$[$n+1]
    sleep 15
done

exec apache2-foreground