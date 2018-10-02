<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Entity;

use Doctrine\ORM\Configuration;
use SAREhub\MicroORM\Entity\EntityManager;
use SAREhub\Servitiom\Util\Database\Cache\CacheConfiguration;
use SAREhub\Servitiom\Util\Database\Cache\EnvCacheConfigurationProvider;
use SAREhub\Servitiom\Util\Database\ConfigurationProvider;
use SAREhub\Servitiom\Util\Database\EntityManagerProvider;
use SAREhub\Servitiom\Util\Database\ProxyConfiguration;
use function DI\autowire;
use function DI\create;
use function DI\factory;


class EntityManagerDefinitions
{

    const PROXY_NAMESPACE = "SAREhub\\Servitiom\\Proxy";

    const ENTITIES_PATH = __DIR__;

    public static function get(): array
    {
        return [
            CacheConfiguration::class => factory(EnvCacheConfigurationProvider::class),
            ProxyConfiguration::class => create()->constructor(self::PROXY_NAMESPACE, false),
            ConfigurationProvider::class => autowire()
                ->constructorParameter("entitiesPaths", [self::ENTITIES_PATH]),
            Configuration::class => factory(ConfigurationProvider::class),
            EntityManager::class => factory(EntityManagerProvider::class)
        ];
    }
}