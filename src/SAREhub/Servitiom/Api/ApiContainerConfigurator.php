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

use DI\ContainerBuilder;
use SAREhub\Microt\App\ContainerConfigurator;
use SAREhub\Servitiom\Api\Routes\ServiceRoutesDefinitions;
use SAREhub\Servitiom\Util\Database\EntityManagerDefinitions;
use SAREhub\Servitiom\Util\UtilDefinitions;


class ApiContainerConfigurator implements ContainerConfigurator
{
    public function configure(ContainerBuilder $builder)
    {
        $builder->addDefinitions(ApiDefinitions::get());
        $this->configureRoutes($builder);
    }

    private function configureRoutes(ContainerBuilder $builder)
    {
        $builder->addDefinitions(ServiceRoutesDefinitions::get());
        $builder->addDefinitions(UtilDefinitions::get());
        $builder->addDefinitions(EntityManagerDefinitions::get());
    }
}
