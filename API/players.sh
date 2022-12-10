#!/bin/bash

# To register a few players or guests.

# To test the example, check if:
# 1.- mysql 'pass' database is created.
# 2.- Migrations are run.
# 3.- An oauth client is created.
# 4.- The token is passed to "detail.sh" and "logout.sh".

echo "To create a player:"
curl -X POST -F 'name=name1' -F 'email=name1@s.com' -F 'password=12345678' -F 'role=player' http://localhost:8000/api/players
curl -X POST -F 'name=name2' -F 'email=name2@s.com' -F 'password=12345678' -F 'role=player' http://localhost:8000/api/players
curl -X POST -F 'name=' -F 'email=name3@s.com' -F 'password=12345678' -F 'role=guest'  http://localhost:8000/api/players
echo

exit 0

