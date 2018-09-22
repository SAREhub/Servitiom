<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

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
