#!/bin/bash

# A player tries to register but some data is wrong (role).

# To test the example, check if:
# 1.- mysql 'pass' database is created.
# 2.- Migrations are run.
# 3.- An oauth client is created.
# 4.- The token is passed to "detail.sh" and "logout.sh".

echo "To create a player:"
curl -v -X POST -F 'name=name1' -F 'email=name1s.com' -F 'password=12345678' -F 'role=playe'  http://localhost:8000/api/players
echo

exit 0

