export IMAGE_NAMESPACE = localhost:5000
export VERSION = test

test_init: test_clean test_init_base test_init_database

test_init_base:
	bash ${BIN_SCRIPTS_PATH}/init.sh

test_init_database:
	bash ${BIN_SCRIPTS_PATH}/database/deploy.sh

test_clean:
	bash ${BIN_SCRIPTS_PATH}/clean.sh
