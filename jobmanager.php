<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

use Psr\Log\LogLevel;
use SAREhub\Commons\Logger\StreamLoggerFactoryProvider;
use SAREhub\DockerUtil\Worker\DefaultUnexpectedErrorHandler;
use SAREhub\DockerUtil\Worker\WorkerBootstrap;
use SAREhub\Servitiom\Job\Manager\JobManagerContainerFactory;
use SAREhub\Servitiom\Util\ErrorHandling;

require __DIR__ . '/vendor/autoload.php';

ErrorHandling::setup();
$defaultLoggerFactory = (new StreamLoggerFactoryProvider(LogLevel::CRITICAL, null))->get();
$errorHandler = new DefaultUnexpectedErrorHandler($defaultLoggerFactory);

$bootstrap = WorkerBootstrap::create(JobManagerContainerFactory::class, $errorHandler);
$bootstrap->run();


