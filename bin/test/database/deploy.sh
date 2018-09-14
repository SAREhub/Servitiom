#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/test/.env
set +a

docker service create \
    --name $DATABASE_SERVICE  \
    ${BASIC_DOCKER_SERVICE_CREATE_ARGS[@]} \
    --secret $DATABASE_PASSWORD_SECRET \
    --publish "${DATABASE_PUBLISH_PORT}:${DATABASE_PORT}" \
    --env MYSQL_ROOT_PASSWORD_FILE="/run/secrets/${DATABASE_PASSWORD_SECRET}" \
    "${DATABASE_SERVICE_IMAGE}" &>/dev/null

dockerutil::print_success "created service: ${DATABASE_SERVICE}"