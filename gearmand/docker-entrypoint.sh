#!/bin/bash
set -eo pipefail
VERBOSE=${VERBOSE:-INFO}
QUEUE_TYPE=${QUEUE_TYPE:-builtin}

# usage: file_env VAR [DEFAULT]
#    ie: file_env 'XYZ_DB_PASSWORD' 'example'
# (will allow for "$XYZ_DB_PASSWORD_FILE" to fill in the value of
#  "$XYZ_DB_PASSWORD" from a file, especially for Docker's secrets feature)
file_env() {
	local var="$1"
	local fileVar="${var}_FILE"
	local def="${2:-}"
	if [ "${!var:-}" ] && [ "${!fileVar:-}" ]; then
		echo >&2 "error: both $var and $fileVar are set (but are exclusive)"
		exit 1
	fi
	local val="$def"
	if [ "${!var:-}" ]; then
		val="${!var}"
	elif [ "${!fileVar:-}" ]; then
		val="$(< "${!fileVar}")"
	fi
	export "$var"="$val"
	unset "$fileVar"
}

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- gearmand "$@"
fi

if [[ "$QUEUE_TYPE" == 'builtin' ]]; then
    echo "$QUEUE_TYPE"
    set -- gearmand \
        --listen=0.0.0.0 \
        --port=4730 \
        --log-file=stderr \
        --verbose=${VERBOSE} \
        --queue-type=builtin
fi

if [[ "$QUEUE_TYPE" == 'mysql' ]]; then
    file_env 'MYSQL_PASSWORD'
    set -- gearmand \
	    --listen=0.0.0.0 \
        --port=4730 \
        --log-file=stderr \
        --verbose=${VERBOSE} \
        --queue-type=MySQL \
        --mysql-host=${MYSQL_HOST:-localhost} \
        --mysql-port=${MYSQL_PORT:-3306} \
        --mysql-user=${MYSQL_USER:-root} \
        --mysql-password=${MYSQL_PASSWORD} \
        --mysql-db=${MYSQL_DB:-Gearmand} \
        --mysql-table=${MYSQL_TABLE:-gearman_queue}
fi

exec "$@"