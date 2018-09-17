#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/prod/.env
set +a
#@TODO replace with new image
docker service create \
    --name "gearmand"  \
    --network "$NETWORK" \
    --label "${TESTENV_LABEL}" \
    --detach=true \
    --with-registry-auth \
    --secret "$GEARMAND_MYSQL_PASSWORD_SECRET" \
    --env QUEUE_TYPE=$GEARMAND_QUEUE_TYPE \
    --env MYSQL_HOST=$GEARMAND_MYSQL_HOST \
    --env MYSQL_PORT=$GEARMAND_MYSQL_PORT \
    --env MYSQL_USER=$GEARMAND_MYSQL_USER \
    --env MYSQL_PASSWORD_FILE="/run/secrets/$GEARMAND_MYSQL_PASSWORD_SECRET" \
    "localhost:5000/gearmand:test" \
    &>/dev/null


dockerutil::print_success "created service: ${DATABASE_SERVICE}"