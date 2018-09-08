#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/test/.env
set +a

export API_GATEWAY_CONFIG_PATH=$(dockerutil::pwd)/api/nginx/nginx.conf
docker stack rm $API_STACK_NAME &>/dev/null
sleep 3
docker stack deploy -c api/docker-stack.yml $API_STACK_NAME
