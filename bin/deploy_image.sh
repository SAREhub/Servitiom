#!/usr/bin/env bash
set -u -e
time docker build --compress=true --tag "${IMAGE}" --file "${IMAGE_DOCKERFILE}" "${IMAGE_BUILD_CONTEXT}"
echo ""
docker push "${IMAGE}"