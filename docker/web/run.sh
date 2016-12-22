#!/bin/bash

chown -R www-data:www-data /var/www/html/storage

n=0
until [ $n -ge 5 ]
do
    php artisan migrate && break  # substitute your command here
    n=$[$n+1]
    sleep 15
done

exec apache2-foreground