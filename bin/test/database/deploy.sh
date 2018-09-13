#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/test/.env
set +a

docker service create \
    --name $DATABASE_SERVICE  \
    --network $NETWORK \
    --secret $DATABASE_PASSWORD_SECRET \
    --publish "${DATABASE_PUBLISH_PORT}:${DATABASE_PORT}" \
    --env MYSQL_ROOT_PASSWORD_FILE="/run/secrets/${DATABASE_PASSWORD_SECRET}" \
    --label "${TESTENV_LABEL}" \
    --detach=true \
    "${DATABASE_SERVICE_IMAGE}" &>/dev/null

dockerutil::print_success "created service: ${DATABASE_SERVICE}"