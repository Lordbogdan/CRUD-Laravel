#!/bin/sh

echo '[+] Composer install'
composer install

echo '[+] Start php-fpm'
exec "php-fpm"
