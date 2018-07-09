.PHONY: deploy_images

export DOCKERUTIL_PATH = ./vendor/sarehub/dockerutil/bin/dockerutil
export PROJECT_SERVICE_ID = servitiom
ENVIRONMENT ?= test

ifeq "$(ENVIRONMENT)" "test"
export BIN_SCRIPTS_PATH = bin/test
include bin/test/Makefile
endif

ifeq "$(ENVIRONMENT)" "prod"
export BIN_SCRIPTS_PATH = bin/deploy
include bin/deploy/Makefile
endif

include api/Makefile


