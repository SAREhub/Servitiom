<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Api;

use SAREhub\MicroORM\Connection\ConnectionPingChecker;
use SAREhub\Microt\HealthCheck\HealthCheckCommand;
use SAREhub\Microt\HealthCheck\HealthCheckResult;

class ApiHealthCheckCommand implements HealthCheckCommand
{
    private $databasePingChecker;

    public function __construct(ConnectionPingChecker $databasePingChecker)
    {
        $this->databasePingChecker = $databasePingChecker;
    }

    public function perform(): HealthCheckResult
    {
        if (!$this->databasePingChecker->check()) {
            return HealthCheckResult::createWarn([
                "database" => "ping fail"
            ]);
        }

        return HealthCheckResult::createPass();
    }
}
