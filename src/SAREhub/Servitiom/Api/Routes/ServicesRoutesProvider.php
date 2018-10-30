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
use SAREhub\Servitiom\Api\Controller\Service\ServicesController;

class ServicesRoutesProvider extends ControllerRoutesProvider
{
    const ATTR_SERVICE_ID = "serviceId";

    protected function getBaseUri(): string
    {
        return Api::uriPattern(Api::VERSION_URI, "services");
    }

    protected function getControllerClass(): string
    {
        return ServicesController::class;
    }

    protected function injectRoutes(ControllerActionRoutes $routes)
    {
        $routes->post("", "create");
        $routes->get("", "getList");
        $uriAttrServiceId = Api::uriAttribute(self::ATTR_SERVICE_ID);
        $routes->get("/" . $uriAttrServiceId, "getOne");
        $routes->delete("/" . $uriAttrServiceId, "delete");
    }
}