export API_APP_IMAGE = $(IMAGE_NAMESPACE)/$(PROJECT_SERVICE_ID)_api:$(VERSION)

deploy_api_image:
	docker build --compress=true --tag $(API_APP_IMAGE) --file api/Dockerfile .
	docker push $(API_APP_IMAGE)

deploy_api: deploy_api_image
	bash "${BIN_SCRIPTS_PATH}/api/deploy.sh"