#!/bin/bash

# To test the example, check if:
# 1.- mysql 'pass' database is created.
# 2.- Migrations are run.
# 3.- An oauth client is created.
# 4.- The token is passed to "detail.sh" and "logout.sh".

# To register a user:
echo "To register:"
curl -X POST -F 'name=name1' -F 'email=name1@s.com' -F 'password=12345678' http://localhost:8000/api/register
curl -X POST -F 'name=name2' -F 'email=name2@s.com' -F 'password=12345678' http://localhost:8000/api/register
curl -X POST -F 'name=name3' -F 'email=name3@s.com' -F 'password=12345678' http://localhost:8000/api/register
echo

exit 0

