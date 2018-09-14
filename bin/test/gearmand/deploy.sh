#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/test/.env
set +a

docker service create \
    --name "gearmand"  \
    --network "$NETWORK" \
    --label "${TESTENV_LABEL}" \
    --detach=true \
    --with-registry-auth \
    "localhost:5000/gearman:test" \
        --listen=0.0.0.0
        --port=4730
        --log-file=stderr \
        --verbose=INFO \
        --queue-type=MySQL \
        --mysql-host=${DATABASE_HOST} \
        --mysql-port=${DATABASE_PORT} \
        --mysql-user=${DATABASE_USER} \
        --mysql-password=test \
        --mysql-db=gearmand \
        --mysql-table=gearmand \
    #&>/dev/null


dockerutil::print_success "created service: ${DATABASE_SERVICE}"