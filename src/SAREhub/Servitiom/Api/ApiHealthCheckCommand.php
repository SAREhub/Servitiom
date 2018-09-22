<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Api;

use SAREhub\MicroODM\Client\DatabasePingChecker;
use SAREhub\Microt\HealthCheck\HealthCheckCommand;
use SAREhub\Microt\HealthCheck\HealthCheckResult;

class ApiHealthCheckCommand implements HealthCheckCommand
{
    /**
     * @var DatabasePingChecker
     */
    private $databasePingChecker;

    public function __construct(DatabasePingChecker $databasePingChecker)
    {
        $this->databasePingChecker = $databasePingChecker;
    }

    public function perform(): HealthCheckResult
    {
        if (!$this->databasePingChecker->execute()) {
            return HealthCheckResult::createWarn([
                "database" => "ping fail"
            ]);
        }

        return HealthCheckResult::createPass();
    }
}
