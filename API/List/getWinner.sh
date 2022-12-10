#!/bin/bash

if [ ${#} != '1' ] ; then
  echo 'Need a token !!!'
  exit 1
fi

token1=${1}

echo "Players average:"
  curl -X GET -H 'Accept: application/json' -H "Authorization: Bearer ${token1}" http://localhost:8000/api/players/ranking/winner/
echo

exit 0

