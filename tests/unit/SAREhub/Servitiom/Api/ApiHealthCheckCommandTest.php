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

namespace SAREhub\Servitiom\Api;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;
use SAREhub\MicroODM\Client\DatabasePingChecker;
use SAREhub\Microt\HealthCheck\HealthCheckResult;

class ApiHealthCheckCommandTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var DatabasePingChecker | Mock
     */
    private $databasePingChecker;

    /**
     * @var ApiHealthCheckCommand
     */
    private $command;

    protected function setUp()
    {
        $this->databasePingChecker = \Mockery::mock(DatabasePingChecker::class);
        $this->command = new ApiHealthCheckCommand($this->databasePingChecker);
    }

    public function testPerformWhenDatabasePingCheckOk()
    {
        $this->databasePingChecker->expects("execute")->andReturn(true);
        $result = $this->command->perform();
        $this->assertEquals($result->getStatus(), HealthCheckResult::PASS_STATUS);
    }

    public function testPerformWhenDatabasePingCheckNotOk()
    {
        $this->databasePingChecker->expects("execute")->andReturn(false);
        $result = $this->command->perform();
        $this->assertEquals($result->getStatus(), HealthCheckResult::WARN_STATUS);
    }
}
