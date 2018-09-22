<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
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
