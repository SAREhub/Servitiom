<?php

namespace SAREhub\Servitiom\Api;

use SAREhub\Microt\HealthCheck\HealthCheckCommand;
use SAREhub\Microt\HealthCheck\HealthCheckResult;

class ApiHealthCheckCommand implements HealthCheckCommand
{
    public function perform(): HealthCheckResult
    {
        return HealthCheckResult::createPass();
    }
}
