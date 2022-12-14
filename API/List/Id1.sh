#!/bin/bash

# A player throws a dice.

# Check "login.sh" for instructions first.

if [ ${#} != '1' ] ; then
  echo 'Need a token !!!'
  exit 1
fi

token=${1}

echo "Player 1 throws:"
for i in $(seq 10); do
  curl -X POST -H 'Accept: application/json' -H "Authorization: Bearer ${token}" http://localhost:8000/api/players/1/games/
done
echo

exit 0

