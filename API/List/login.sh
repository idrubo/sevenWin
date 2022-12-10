#!/bin/bash

email1='name1@s.com'
email2='name2@s.com'

echo "To create a player:"
curl -X POST -F 'name=name1' -F "email=${email1}" -F 'password=12345678' -F 'role=player' http://localhost:8000/api/players
curl -X POST -F 'name=name2' -F "email=${email2}" -F 'password=12345678' -F 'role=player' http://localhost:8000/api/players
curl -X POST -F 'name=' -F 'email=name3@s.com' -F 'password=12345678' -F 'role=guest'  http://localhost:8000/api/players
echo

# To login:
echo "To login:"
curl -X POST -F "email=${email1}" -F 'password=12345678' http://localhost:8000/api/login > token1
curl -X POST -F "email=${email2}" -F 'password=12345678' http://localhost:8000/api/login > token2
echo

exit 0

