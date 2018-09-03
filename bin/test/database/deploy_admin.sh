#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/.env
source ./bin/test/.env
set +a

docker service create \
    --name ${MONGODB_SERVICE_ADMIN} \
    --network $NETWORK \
    --label $TESTENV_LABEL \
    --publish ${DATABASE_ADMIN_PUBLISH_PORT}:8081 \
    --env ME_CONFIG_OPTIONS_EDITORTHEME="ambiance" \
    --env ME_CONFIG_MONGODB_ADMINUSERNAME=$DATABASE_USER \
    --env ME_CONFIG_MONGODB_ADMINPASSWORD=$TEST_PASSWORD \
    --env ME_CONFIG_MONGODB_SERVER="$MONGODB_SERVICE" \
    --detach=true \
    mongo-express &>/dev/null

dockerutil::print_success "created service: $DATABASE_SERVICE"