<?php

use SAREhub\Commons\Misc\ErrorHandlerHelper;
use SAREhub\Microt\App\AppBootstrap;
use SAREhub\Servitiom\Api\Api;

require __DIR__ . '/vendor/autoload.php';

ErrorHandlerHelper::hideDisplayErrors();
ErrorHandlerHelper::enableErrorReporting(E_ALL);

AppBootstrap::create(Api::getAppRunOptions())->run();
