#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/.env
source ./bin/test/.env
set +a

echo $DATABASE_PASSWORD | docker secret create --label $TESTENV_LABEL $DATABASE_PASSWORD_SECRET -

docker service create \
    --publish "$DATABASE_SERVICE_PUBLISH_PORT:$DATABASE_PORT" \
    --name $DATABASE_SERVICE  \
    --env MONGO_INITDB_ROOT_USERNAME=$DATABASE_USER \
    --env MONGO_INITDB_ROOT_PASSWORD=$DATABASE_PASSWORD \
    --network $NETWORK \
    --label $TESTENV_LABEL \
    --detach=true \
    $DATABASE_SERVICE_IMAGE

dockerutil::print_success "created service: $DATABASE_SERVICE"