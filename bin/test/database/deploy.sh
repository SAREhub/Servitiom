#!/bin/bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/.env
source ./bin/test/.env
set +a

docker service create \
    --name $DATABASE_SERVICE \
    --network $NETWORK \
    --publish "${DATABASE_PUBLISH_PORT}:3306" \
    --secret $DATABASE_PASSWORD_SECRET \
    --env "MYSQL_ROOT_PASSWORD_FILE=/run/secrets/${DATABASE_PASSWORD_SECRET}" \
    --label $TESTENV_LABEL \
    --detach \
    --limit-cpu "2"  \
    --limit-memory "512M"  \
    $DATABASE_SERVICE_IMAGE &>/dev/null

dockerutil::print_success "created service: $DATABASE_SERVICE"
