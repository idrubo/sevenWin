#!/bin/bash

# A player or a guest logs in.

# To test the example, check if:
# 1.- mysql 'pass' database is created.
# 2.- Migrations are run.
# 3.- An oauth client is created.
# 4.- The token is passed to "detail.sh" and "logout.sh".

if [ ${#} != '1' ] ; then
  echo 'Need an email !!!'
  exit 1
fi

email=${1}

echo "To login:"
curl -X POST -F "email=${email}" -F 'password=12345678' http://localhost:8000/api/login
echo

exit 0

