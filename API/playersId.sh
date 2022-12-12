#!/bin/bash

# Check "login.sh" for instructions first.

if [ ${#} != '1' ] ; then
  echo 'Need a token !!!'
  exit 1
fi

token=${1}

echo "Player changes his name:"
curl -X PUT -H 'Accept: application/json' -H "Authorization: Bearer ${token}" -d 'name=name11' http://localhost:8000/api/players/1/
echo

exit 0

