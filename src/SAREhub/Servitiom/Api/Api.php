<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Api;

use SAREhub\Microt\App\AppRunOptions;
use SAREhub\Microt\App\Auth\BasicAuthContainerConfigurator;
use SAREhub\Microt\App\BasicContainerConfigurator;
use SAREhub\Microt\App\ChainContainerConfigurator;
use SAREhub\Microt\App\ContainerConfigurator;
use SAREhub\Microt\App\Middleware\AppMiddlewaresInjector;
use SAREhub\Microt\App\Middleware\MiddlewareInjector;

class Api
{
    const VERSION_URI = "/v1";
    const ENTRY_MIDDLEWARES = "api.middlewares";

    public static function getAppRunOptions(): AppRunOptions
    {
        return AppRunOptions::createWithCompiledContainer(
            self::getContainerConfigurator(),
            self::getMiddlewareInjector()
        );
    }

    private static function getContainerConfigurator(): ContainerConfigurator
    {
        return new ChainContainerConfigurator([
            new BasicContainerConfigurator(),
            new BasicAuthContainerConfigurator(),
            new ApiContainerConfigurator()
        ]);
    }

    private static function getMiddlewareInjector(): MiddlewareInjector
    {
        return new AppMiddlewaresInjector(self::ENTRY_MIDDLEWARES);
    }
}
