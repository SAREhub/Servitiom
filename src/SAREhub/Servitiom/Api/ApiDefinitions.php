<?php

namespace SAREhub\Servitiom\Api;

use SAREhub\Microt\App\Auth\BasicAuthMiddlewareInjector;
use SAREhub\Microt\Util\ValidatorHelper;
use function DI\autowire;
use function DI\get;

class ApiDefinitions
{
    public static function get(): array
    {
        return [
            ValidatorHelper::class => autowire(),
            Api::ENTRY_MIDDLEWARES => [
                get(BasicAuthMiddlewareInjector::class),
            ],
        ];
    }
}
