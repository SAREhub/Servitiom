<?php

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