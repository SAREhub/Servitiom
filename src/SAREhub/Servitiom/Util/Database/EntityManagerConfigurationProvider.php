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

namespace SAREhub\Servitiom\Util\Database;

use Doctrine\Common\Cache\Cache;
use Doctrine\ORM\Configuration;
use SAREhub\Commons\Misc\InvokableProvider;

class EntityManagerConfigurationProvider extends InvokableProvider
{

    /**
     * @var Cache
     */
    private $cache;

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache, string $entitiesPath)
    {
        $this->cache = $cache;
    }

    public function get()
    {
        $config = new Configuration;
        $config->setMetadataCacheImpl($this->cache);
        $driverImpl = $config->newDefaultAnnotationDriver();
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($this->cache);

        $config->setProxyDir('/path/to/myproject/lib/MyProject/Proxies');
        $config->setProxyNamespace('MyProject\Proxies');
        $config->setAutoGenerateProxyClasses(false);
        return $config;
    }


}