<?php
/**
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
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
