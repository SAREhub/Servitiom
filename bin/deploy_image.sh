#!/usr/bin/env bash

time docker build --compress=true --tag "${IMAGE}" --file "${IMAGE_DOCKERFILE}" "${IMAGE_BUILD_CONTEXT}"
echo ""
docker push "${IMAGE}"