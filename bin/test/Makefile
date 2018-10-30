export IMAGE_NAMESPACE = localhost:5000
export VERSION = test

## Runs docker local registry container for pushing test images
test_init_local_registry:
	docker run -d -p 5000:5000 --restart=always --name registry registry:2

## Cleans test env and inits all depending services like database
test_init: test_clean test_init_base test_init_database test_init_database_admin

## Creates test secrets and network
test_init_base:
	bash ${BIN_SCRIPTS_PATH}/init.sh

## Creates test database service
test_init_database:
	bash ${BIN_SCRIPTS_PATH}/database/deploy.sh

## Creates test database admin service
test_init_database_admin:
	bash ${BIN_SCRIPTS_PATH}/database/deploy_admin.sh

## Cleans test env
test_clean:
	bash ${BIN_SCRIPTS_PATH}/clean.sh
