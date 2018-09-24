<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Entity;

use Doctrine\ORM\Configuration;
use Psr\Container\ContainerInterface;
use SAREhub\MicroORM\Connection\ConnectionOptions;
use SAREhub\MicroORM\Entity\EntityManager;
use SAREhub\Servitiom\Util\Database\CacheConfiguration;
use SAREhub\Servitiom\Util\Database\ConfigurationProvider;
use SAREhub\Servitiom\Util\Database\EntityManagerProvider;
use SAREhub\Servitiom\Util\Database\EnumTypeMappingRegistrant;
use SAREhub\Servitiom\Util\Database\EnvCacheConfigurationProvider;
use SAREhub\Servitiom\Util\Database\ProxyConfiguration;
use function DI\autowire;
use function DI\create;
use function DI\decorate;
use function DI\factory;


class EntityManagerDefinitions
{

    public static function get(): array
    {
        return [
            CacheConfiguration::class => factory(EnvCacheConfigurationProvider::class),
            ProxyConfiguration::class => create()->constructor("SAREhub\\Servitiom\\Proxy", false),
            ConfigurationProvider::class => autowire()
                ->constructorParameter("entitiesPaths", [__DIR__]),
            Configuration::class => factory(ConfigurationProvider::class),
            EntityManager::class => factory(EntityManagerProvider::class),
            EnumTypeMappingRegistrant::class => create()->constructor([]),
            ConnectionOptions::class => decorate(function (ConnectionOptions $options, ContainerInterface $c) {
                $c->get(EnumTypeMappingRegistrant::class)->register($options->getParams()["platform"]);
                return $options;
            })
        ];
    }
}