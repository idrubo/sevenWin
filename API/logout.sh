#!/bin/bash

# A player or a guest logs out.

# Check "login.sh" for instructions first.

if [ ${#} != '1' ] ; then
  echo 'Need a token !!!'
  exit 1
fi

token=${1}

echo "To logout:"
curl -X POST -H 'Accept: application/json' -H "Authorization: Bearer ${token}" http://localhost:8000/api/logout
echo

exit 0

