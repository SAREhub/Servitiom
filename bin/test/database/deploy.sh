#!/bin/bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/.env
source ./bin/test/.env
set +a

echo $DATABASE_PASSWORD | docker secret create --label $TESTENV_LABEL $DATABASE_PASSWORD_SECRET -
dockerutil::print_success "created secret ${DATABASE_PASSWORD_SECRET}"

docker service create \
    --publish "$DATABASE_SERVICE_PUBLISH_PORT:27017" \
    --name $DATABASE_SERVICE  \
    --env MONGO_INITDB_ROOT_USERNAME=$DATABASE_USER \
    --env MONGO_INITDB_ROOT_PASSWORD=$DATABASE_PASSWORD \
    --network $NETWORK \
    --label $TESTENV_LABEL \
    --detach=true \
    $DATABASE_SERVICE_IMAGE

dockerutil::print_success "created service: $MONGODB_SERVICE"

docker service create \
    --name ${MONGODB_SERVICE_ADMIN} \
    --network $NETWORK \
    --label $TESTENV_LABEL \
    --publish ${MONGODB_SERVICE_ADMIN_PUBLISH_PORT}:8081 \
    --env ME_CONFIG_OPTIONS_EDITORTHEME="ambiance" \
    --env ME_CONFIG_MONGODB_ADMINUSERNAME=$DATABASE_USER \
    --env ME_CONFIG_MONGODB_ADMINPASSWORD=$DATABASE_PASSWORD \
    --env ME_CONFIG_MONGODB_SERVER="$MONGODB_SERVICE" \
    --detach=true \
    mongo-express

dockerutil::print_success "created service: $MONGODB_SERVICE_ADMIN"