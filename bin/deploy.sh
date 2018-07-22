#!/bin/bash

cd /var/www/releases/new
rm -rf storage/
ln -nfs ../../data/storage storage
chown php-fpm:php-fpm storage

cd /var/www/releases
rm -rf old
mkdir -p current
mv current old
mv new current

cd /var/www/releases/current
php artisan migrate --force