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

use Doctrine\Common\Cache\VoidCache;
use Doctrine\DBAL\Platforms\MySQL57Platform;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use SAREhub\Commons\Misc\ErrorHandlerHelper;

require __DIR__ . '/vendor/autoload.php';

ErrorHandlerHelper::enableErrorReporting(E_ALL);

$cache = new VoidCache();
$config = new Configuration;
$config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver("src/SAREhub/Servitiom/Entity");
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);
$config->setProxyDir("Proxies");
$config->setProxyNamespace('SAREhub\\Servitiom\\Proxy');
$config->setAutoGenerateProxyClasses(false);

$connectionOptions = array(
    'platform' => new MySQL57Platform(),
    'driver' => "pdo_mysql"
);

$entityManager = EntityManager::create($connectionOptions, $config);

$helperSet = ConsoleRunner::createHelperSet($entityManager);

$cli = ConsoleRunner::createApplication($helperSet);


$cli->run();