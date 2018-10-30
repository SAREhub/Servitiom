<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Api\Routes;


use SAREhub\Microt\App\Controller\ControllerActionRoutes;
use SAREhub\Microt\App\Controller\ControllerRoutesProvider;
use SAREhub\Servitiom\Api\Api;
use SAREhub\Servitiom\Api\Controller\Service\ServiceInstancesController;

class ServiceInstancesRoutesProvider extends ControllerRoutesProvider
{
    const ATTR_SERVICE_INSTANCE_ID = "serviceInstanceId";

    protected function getBaseUri(): string
    {
        return Api::uriPattern(
            Api::VERSION_URI,
            "services",
            Api::uriAttribute(ServicesRoutesProvider::ATTR_SERVICE_ID),
            "instances"
        );
    }

    protected function getControllerClass(): string
    {
        return ServiceInstancesController::class;
    }

    protected function injectRoutes(ControllerActionRoutes $routes)
    {
        $routes->post("", "create");
        $routes->get("", "getList");
        $uriAttrServiceInstanceId = Api::uriAttribute(self::ATTR_SERVICE_INSTANCE_ID);
        $routes->get("/" . $uriAttrServiceInstanceId, "getOne");
        $routes->delete("/" . $uriAttrServiceInstanceId, "delete");
    }
}