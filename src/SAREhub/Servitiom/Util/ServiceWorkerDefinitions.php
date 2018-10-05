<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Util;


use function DI\add;
use function DI\create;
use DI\Definition\Helper\DefinitionHelper;
use function DI\get;
use SAREhub\Commons\Logger\BasicLoggingDefinitions;
use SAREhub\Commons\Service\ServiceManager;
use SAREhub\Commons\Task\Sequence;
use SAREhub\DockerUtil\Worker\StandardWorker;
use SAREhub\DockerUtil\Worker\Worker;

class ServiceWorkerDefinitions
{
    const WORKER_LOGGER_NAME = "Worker";

    const ENTRY_WORKER_SERVICES = "Worker.services";
    const ENTRY_INIT_TASKS = "Worker.initTasks";

    public static function get(): array
    {
        return [
            Worker::class => self::workerDefinition(),
            self::ENTRY_INIT_TASKS => add([]),
            self::ENTRY_WORKER_SERVICES => add([])
        ];
    }

    private static function workerDefinition(): DefinitionHelper
    {
        $initTask = self::workerInitTaskDefinition();
        $serviceManager = self::workerServiceManagerDefinition();
        $worker = create(StandardWorker::class)->constructor($initTask, $serviceManager);
        return BasicLoggingDefinitions::inject($worker, self::WORKER_LOGGER_NAME);
    }

    private static function workerInitTaskDefinition(): DefinitionHelper
    {
        return create(Sequence::class)->constructor(get(self::ENTRY_INIT_TASKS));
    }

    private static function workerServiceManagerDefinition(): DefinitionHelper
    {
        return create(ServiceManager::class)->constructor(get(self::ENTRY_WORKER_SERVICES));
    }
}