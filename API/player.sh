#!/bin/bash

# Check "login.sh" for instructions first.

if [ ${#} != '1' ] ; then
  echo 'Need a token !!!'
  exit 1
fi

token=${1}


# To get protected data:
echo "User details:"
curl -X POST -H 'Accept: application/json' -H "Authorization: Bearer ${token}" http://localhost:8000/api/player
echo

exit 0

