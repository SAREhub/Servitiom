<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Api;

use DI\ContainerBuilder;
use SAREhub\Microt\App\ContainerConfigurator;
use SAREhub\Servitiom\Api\Routes\RoutesDefinitions;
use SAREhub\Servitiom\Entity\EntityManagerDefinitions;
use SAREhub\Servitiom\Util\UtilDefinitions;


class ApiContainerConfigurator implements ContainerConfigurator
{
    public function configure(ContainerBuilder $builder)
    {
        $builder->addDefinitions(UtilDefinitions::get());
        $builder->addDefinitions(EntityManagerDefinitions::get());
        $builder->addDefinitions(ApiDefinitions::get());
        $builder->addDefinitions(RoutesDefinitions::get());
    }

}
