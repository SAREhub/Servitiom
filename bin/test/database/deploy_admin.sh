#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/test/.env
set +a

docker service create \
    --name ${DATABASE_SERVICE_ADMIN} \
    ${BASIC_DOCKER_SERVICE_CREATE_ARGS[@]} \
    --publish ${DATABASE_ADMIN_PUBLISH_PORT}:${DATABASE_ADMIN_PORT} \
    --env PMA_HOST="${DATABASE_HOST}" \
    --env PMA_PORT="${DATABASE_PORT}" \
    ${DATABASE_ADMIN_IMAGE} &>/dev/null

dockerutil::print_success "created service: $DATABASE_SERVICE_ADMIN"