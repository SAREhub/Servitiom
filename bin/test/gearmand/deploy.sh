#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/test/.env
set +a

docker service create \
    --name "${GEARMAND_SERVICE}"  \
    --network "${NETWORK}" \
    --label "${TESTENV_LABEL}" \
    --detach=true \
    --with-registry-auth \
    --env QUEUE_TYPE="${GEARMAND_QUEUE_TYPE}" \
    "${GEARMAND_SERVICE_IMAGE}" \
    &>/dev/null

dockerutil::print_success "created service: ${DATABASE_SERVICE}"