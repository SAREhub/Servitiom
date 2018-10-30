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
use SAREhub\Servitiom\Api\Controller\Tenant\TenantsController;

class TenantsRoutesProvider extends ControllerRoutesProvider
{
    const ATTR_TENANT_ID = "tenantId";

    protected function getBaseUri(): string
    {
        return Api::uriPattern(Api::VERSION_URI, "tenants");
    }

    protected function getControllerClass(): string
    {
        return TenantsController::class;
    }

    protected function injectRoutes(ControllerActionRoutes $routes)
    {
        $routes->post("", "create");
        $routes->get("", "getList");
        $uriAttrTenantId = Api::uriAttribute(self::ATTR_TENANT_ID);
        $routes->get("/" . $uriAttrTenantId, "getOne");
        $routes->delete("/" . $uriAttrTenantId, "delete");
    }
}