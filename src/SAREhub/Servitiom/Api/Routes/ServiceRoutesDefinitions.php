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