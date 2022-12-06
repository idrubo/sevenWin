#!/bin/bash

# Check "login.sh" for instructions first.

if [ ${#} != '1' ] ; then
  echo 'Need a token !!!'
  exit 1
fi

token=${1}

echo "Player throw:"
curl -X DELETE -H 'Accept: application/json' -H "Authorization: Bearer ${token}" http://localhost:8000/api/players/3/games/
echo

exit 0

