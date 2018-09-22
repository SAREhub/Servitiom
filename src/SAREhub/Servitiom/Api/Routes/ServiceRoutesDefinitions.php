<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Api\Routes;

use SAREhub\Microt\HealthCheck\HealthCheckCommand;
use SAREhub\Microt\HealthCheck\HealthCheckRoutesProvider;
use SAREhub\Servitiom\Api\Api;
use SAREhub\Servitiom\Api\ApiHealthCheckCommand;
use function DI\add;
use function DI\create;
use function DI\factory;
use function DI\get;

class ServiceRoutesDefinitions
{
    const SERVICE_BASE_URI = Api::VERSION_URI . "/service";

    public static function get()
    {
        return [
            HealthCheckCommand::class => get(ApiHealthCheckCommand::class),
            HealthCheckRoutesProvider::class => create()->constructor(self::SERVICE_BASE_URI),

            Api::ENTRY_MIDDLEWARES => add([
                factory(HealthCheckRoutesProvider::class),
            ])
        ];
    }
}