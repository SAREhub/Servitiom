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

use Doctrine\Common\Proxy\AbstractProxyFactory;
use Doctrine\ORM\Configuration;
use SAREhub\Commons\Misc\InvokableProvider;

class ConfigurationProvider extends InvokableProvider
{

    /**
     * @var CacheConfiguration
     */
    private $cacheConfig;

    /**
     * @var array
     */
    private $entitiesPaths;

    /**
     * @var ProxyConfiguration
     */
    private $proxyConfig;

    public function __construct(CacheConfiguration $cacheConfig, ProxyConfiguration $proxyConfig, array $entitiesPaths)
    {
        $this->cacheConfig = $cacheConfig;
        $this->proxyConfig = $proxyConfig;
        $this->entitiesPaths = $entitiesPaths;
    }

    public function get()
    {
        $config = new Configuration();
        $this->setupCache($config);
        $this->setupProxy($config);
        $this->setupMetadataDriver($config);
        return $config;
    }

    private function setupCache(Configuration $config): void
    {
        $config->setMetadataCacheImpl($this->cacheConfig->getMetadataCache());
        $config->setQueryCacheImpl($this->cacheConfig->getQueryCache());
    }

    private function setupProxy(Configuration $config): void
    {
        $config->setProxyDir($this->proxyConfig->getDir());
        $config->setProxyNamespace($this->proxyConfig->getNamespace());
        $config->setAutoGenerateProxyClasses($this->proxyConfig->isGenerateOnFly() ?
            AbstractProxyFactory::AUTOGENERATE_EVAL :
            AbstractProxyFactory::AUTOGENERATE_NEVER
        );
    }

    private function setupMetadataDriver(Configuration $config): void
    {
        $driver = $config->newDefaultAnnotationDriver($this->entitiesPaths);
        $config->setMetadataDriverImpl($driver);
    }
}