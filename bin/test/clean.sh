#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/.env
source ./bin/test/.env
set +a

docker stack rm $API_STACK_NAME 2>/dev/null
dockerutil::clean_all_with_label $TESTENV_LABEL
