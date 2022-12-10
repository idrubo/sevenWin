#!/bin/bash

# A player throws a dice.

# Check "login.sh" for instructions first.

if [ ${#} != '1' ] ; then
  echo 'Need a token !!!'
  exit 1
fi

token2=${1}

echo "Player 2 throws:"
for i in $(seq 15); do
  curl -X POST -H 'Accept: application/json' -H "Authorization: Bearer ${token2}" http://localhost:8000/api/players/2/games/
done
echo

exit 0

