#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/test/.env
set +a

docker service create \
    --name "${BEANSTALKD_SERVICE}"  \
    ${BASIC_DOCKER_SERVICE_CREATE_ARGS[@]} \
    "${BEANSTALKD_SERVICE_IMAGE}" \
    -V &>/dev/null

dockerutil::print_success "created service: ${BEANSTALKD_SERVICE}"