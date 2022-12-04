#!/bin/bash

# To test the example, check if:
# 1.- mysql 'pass' database is created.
# 2.- Migrations are run.
# 3.- An oauth client is created.
# 4.- The token is passed to "detail.sh" and "logout.sh".

# To register a user:
echo "To register:"
# curl -v -X POST -F 'name=name1' -F 'email=name1s.com' -F 'password=12345678' -F 'role=player' http://localhost:8000/api/register
curl -v -X POST -F 'name=name1' -F 'email=name1s.com' -F 'password=12345678' -F 'role=playe'  http://localhost:8000/api/register
echo

exit 0

