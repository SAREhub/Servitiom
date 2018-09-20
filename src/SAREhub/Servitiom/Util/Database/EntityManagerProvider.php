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

use Doctrine\DBAL\Connection;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use SAREhub\Commons\Misc\InvokableProvider;

class EntityManagerProvider extends InvokableProvider
{

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Connection $connection, Configuration $configuration)
    {
        $this->connection = $connection;
        $this->configuration = $configuration;
    }

    public function get()
    {
        return EntityManager::create($this->connection, $this->configuration);
    }
}