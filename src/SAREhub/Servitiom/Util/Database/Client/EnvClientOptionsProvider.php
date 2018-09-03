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

namespace SAREhub\Servitiom\Util\Database\Client;

use SAREhub\Commons\Misc\EnvironmentHelper;
use SAREhub\Commons\Misc\InvokableProvider;
use SAREhub\Commons\Secret\SecretValueNotFoundException;
use SAREhub\Commons\Secret\SecretValueProvider;
use SAREhub\MicroODM\Client\ClientOptions;

class EnvClientOptionsProvider extends InvokableProvider
{
    const ENV_HOST = "DATABASE_HOST";
    const ENV_PORT = "DATABASE_PORT";

    const ENV_USER = "DATABASE_USER";
    const ENV_PASSWORD_SECRET = "DATABASE_PASSWORD_SECRET";

    /**
     * @var SecretValueProvider
     */
    private $secretValueProvider;

    public function __construct(SecretValueProvider $secretValueProvider)
    {
        $this->secretValueProvider = $secretValueProvider;
    }

    /**
     * @return ClientOptions
     * @throws SecretValueNotFoundException
     */
    public function get()
    {
        return ClientOptions::newInstance()
            ->withHost(EnvironmentHelper::getRequiredVar(self::ENV_HOST))
            ->withPort(EnvironmentHelper::getRequiredVar(self::ENV_PORT))
            ->withUser(EnvironmentHelper::getRequiredVar(self::ENV_USER))
            ->withPassword($this->getPasswordFromEnv());
    }

    /**
     * @return string
     * @throws SecretValueNotFoundException
     */
    private function getPasswordFromEnv(): string
    {
        return $this->secretValueProvider->get(EnvironmentHelper::getRequiredVar(self::ENV_PASSWORD_SECRET));
    }
}