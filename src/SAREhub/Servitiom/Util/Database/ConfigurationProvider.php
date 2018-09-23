<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
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
     * @var ProxyConfiguration
     */
    private $proxyConfig;

    /**
     * @var array
     */
    private $entitiesPaths;

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