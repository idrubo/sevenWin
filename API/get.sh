#!/bin/bash

# A player lists all his throws.

# Check "login.sh" for instructions first.

if [ ${#} != '1' ] ; then
  echo 'Need a token !!!'
  exit 1
fi

token=${1}

echo "Player list all his throws:"
curl -X GET -H 'Accept: application/json' -H "Authorization: Bearer ${token}" http://localhost:8000/api/players/1/games/
echo

exit 0

