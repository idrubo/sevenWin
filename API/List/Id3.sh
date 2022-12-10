#!/bin/bash

# A player throws a dice.

# Check "login.sh" for instructions first.

if [ ${#} != '1' ] ; then
  echo 'Need a token !!!'
  exit 1
fi

token3=${1}

echo "Player 2 throws:"
for i in $(seq 20); do
  curl -X POST -H 'Accept: application/json' -H "Authorization: Bearer ${token3}" http://localhost:8000/api/players/3/games/
done
echo

exit 0

