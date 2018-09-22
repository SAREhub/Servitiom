<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Api;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SAREhub\MicroORM\Connection\ConnectionPingChecker;
use SAREhub\Microt\HealthCheck\HealthCheckResult;

class ApiHealthCheckCommandTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var ConnectionPingChecker | MockInterface
     */
    private $databasePingChecker;

    /**
     * @var ApiHealthCheckCommand
     */
    private $command;

    protected function setUp()
    {
        $this->databasePingChecker = \Mockery::mock(ConnectionPingChecker::class);
        $this->command = new ApiHealthCheckCommand($this->databasePingChecker);
    }

    public function testPerformWhenDatabasePingCheckOk()
    {
        $this->databasePingChecker->expects("check")->andReturn(true);
        $result = $this->command->perform();
        $this->assertEquals($result->getStatus(), HealthCheckResult::PASS_STATUS);
    }

    public function testPerformWhenDatabasePingCheckNotOk()
    {
        $this->databasePingChecker->expects("check")->andReturn(false);
        $result = $this->command->perform();
        $this->assertEquals($result->getStatus(), HealthCheckResult::WARN_STATUS);
    }
}
