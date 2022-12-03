#!/bin/bash

echo "Migrations:"
/c/xampp_1/php/php artisan migrate

echo "Keys:"
/c/xampp_1/php/php artisan passport:install

# echo "Client:"
# /c/xampp_1/php/php artisan passport:client

exit 0

