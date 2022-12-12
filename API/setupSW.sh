#!/bin/bash

echo "Migrations:"
/c/xampp_2/php/php artisan migrate

echo "Passport Keys:"
/c/xampp_2/php/php artisan passport:install

echo "App keys:"
/c/xampp_2/php/php artisan key:generate

# echo "Client:"
# /c/xampp_2/php/php artisan passport:client

exit 0

