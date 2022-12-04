#!/bin/bash

echo "Migrations:"
php artisan migrate

echo "Keys:"
php artisan passport:install

# echo "Client:"
# /c/xampp_1/php/php artisan passport:client

exit 0

