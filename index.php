<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

use SAREhub\Commons\Misc\ErrorHandlerHelper;
use SAREhub\Microt\App\AppBootstrap;
use SAREhub\Servitiom\Api\Api;

require __DIR__ . '/vendor/autoload.php';

ErrorHandlerHelper::hideDisplayErrors();
ErrorHandlerHelper::enableErrorReporting(E_ALL);

AppBootstrap::create(Api::getAppRunOptions())->run();
