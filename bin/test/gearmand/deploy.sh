#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/test/.env
set +a

docker service create \
    --name "${GEARMAND_SERVICE}"  \
    ${BASIC_DOCKER_SERVICE_CREATE_ARGS[@]} \
    --env QUEUE_TYPE="${GEARMAND_QUEUE_TYPE}" \
    "${GEARMAND_SERVICE_IMAGE}" \
    &>/dev/null

dockerutil::print_success "created service: ${DATABASE_SERVICE}"