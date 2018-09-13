#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a

source ./bin/test/.env
set +a

docker stack rm $API_STACK_NAME 2>/dev/null

set +e
n=0
until [ $n -ge 5 ]
do
    dockerutil::clean_all_with_label $TESTENV_LABEL && break
    n=$[$n+1]
    sleep 2
done
set -e
