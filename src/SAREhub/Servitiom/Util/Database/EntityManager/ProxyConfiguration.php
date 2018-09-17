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

namespace SAREhub\Servitiom\Util\Database\EntityManager;

class ProxyConfiguration
{
    /**
     * @var string
     */
    private $namespace;

    /**
     * @var bool
     */
    private $generateOnFly;

    /**
     * @var string
     */
    private $dir;

    public function __construct(string $namespace, bool $generateOnFly = true, string $dir = '')
    {
        $this->namespace = $namespace;
        $this->generateOnFly = $generateOnFly;
        $this->dir = $dir;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function isGenerateOnFly(): bool
    {
        return $this->generateOnFly;
    }

    public function getDir(): string
    {
        return $this->dir;
    }


}