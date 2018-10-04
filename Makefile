export DOCKERUTIL_ROOT_PATH = ./vendor/sarehub/dockerutil/bin
export DOCKERUTIL_PATH = $(DOCKERUTIL_ROOT_PATH)/dockerutil
export PROJECT = servitiom

INFO = Showing targets for selected ENVIRONMENT(default: test)
EXTRA_MAKE_ARGS = ENVIRONMENT=test|prod
HELP_TARGET_MAX_CHAR_NUM=30
SUBPROJECTS = api
include $(DOCKERUTIL_ROOT_PATH)/MakeHelp

export ENVIRONMENT ?= test
ifeq "$(ENVIRONMENT)" "test"
export BIN_SCRIPTS_PATH = bin/test
include bin/test/Makefile
endif

ifeq "$(ENVIRONMENT)" "prod"
export BIN_SCRIPTS_PATH = bin/prod
include bin/prod/Makefile
endif

export IMAGE = $(IMAGE_NAMESPACE)/$(PROJECT)_$*:$(VERSION)
export IMAGE_DOCKERFILE = $*/Dockerfile
export IMAGE_BUILD_CONTEXT = .

define subproject_target
	$(addprefix $(1)_,$(SUBPROJECTS))
endef

_subproject_deploy_image = $(call subproject_target,deploy_image)
## Deploys selected subproject image
$(_subproject_deploy_image): deploy_image_%:
	bash bin/deploy_image.sh

_subproject_deploy = $(call subproject_target,deploy)
## Deploys selected subproject service
$(_subproject_deploy): deploy_%:
	bash "${BIN_SCRIPTS_PATH}/$*/deploy.sh"


