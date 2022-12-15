#!/bin/bash

if [ ${#} != '1' ] ; then
  echo 'Need a token !!!'
  exit 1
fi

token=${1}

echo "Players average:"
  curl -X GET -H 'Accept: application/json' -H "Authorization: Bearer ${token}" http://localhost:8000/api/players/ranking/winner/
echo

exit 0

