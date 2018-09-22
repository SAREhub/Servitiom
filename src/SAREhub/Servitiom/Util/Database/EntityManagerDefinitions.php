<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Util\Database;

use Doctrine\ORM\Configuration;
use SAREhub\MicroORM\Entity\EntityManager;
use function DI\autowire;
use function DI\create;
use function DI\factory;


class EntityManagerDefinitions
{
    const ENV_DATABASE_NAME = "DATABASE_NAME";

    public static function get(): array
    {
        return [
            CacheConfiguration::class => factory(EnvCacheConfigurationProvider::class),
            ProxyConfiguration::class => create()->constructor("SAREhub\\Servitiom\\Proxy", false),
            ConfigurationProvider::class => autowire()
                ->constructorParameter("entitiesPaths", ["src/SAREhub/Servitiom/Entity"]),
            Configuration::class => factory(ConfigurationProvider::class),
            EntityManager::class => factory(EntityManagerProvider::class)
        ];
    }
}