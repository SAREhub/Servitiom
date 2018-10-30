<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\JobWorker;


use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use SAREhub\Commons\Logger\BasicLoggingDefinitions;
use SAREhub\DockerUtil\Container\ContainerFactory;
use SAREhub\Servitiom\Entity\EntityManagerDefinitions;
use SAREhub\Servitiom\Util\Database\ConnectionDefinitions;
use SAREhub\Servitiom\Util\ServiceWorkerDefinitions;
use SAREhub\Servitiom\Util\UtilDefinitions;

class JobWorkerContainerFactory implements ContainerFactory
{
    /**
     * @return ContainerInterface
     * @throws \Exception
     */
    public function create(): ContainerInterface
    {
        $builder = new ContainerBuilder();
        $this->configureOptions($builder);
        $this->addDefinitions($builder);
        return $builder->build();
    }

    private function configureOptions(ContainerBuilder $builder): void
    {
        $builder->useAnnotations(false)->useAutowiring(true);
    }

    private function addDefinitions(ContainerBuilder $builder): void
    {
        $this->addUtilDefinitions($builder);
        $builder->addDefinitions(ServiceWorkerDefinitions::get());
    }

    private function addUtilDefinitions(ContainerBuilder $builder): void
    {
        $builder->addDefinitions(BasicLoggingDefinitions::get());
        $builder->addDefinitions(UtilDefinitions::get());
        $this->addDatabaseDefinitions($builder);
    }

    private function addDatabaseDefinitions(ContainerBuilder $builder): void
    {
        $builder->addDefinitions(ConnectionDefinitions::get());
        $builder->addDefinitions(EntityManagerDefinitions::get());
    }

}