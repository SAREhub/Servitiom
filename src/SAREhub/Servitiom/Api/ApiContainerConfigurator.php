<?php

namespace SAREhub\Servitiom\Api;

use DI\ContainerBuilder;
use SAREhub\Microt\App\ContainerConfigurator;
use SAREhub\Servitiom\Api\Routes\ServiceRoutesDefinitions;


class ApiContainerConfigurator implements ContainerConfigurator
{
    public function configure(ContainerBuilder $builder)
    {
        $builder->addDefinitions(ApiDefinitions::get());
        $this->configureRoutes($builder);
    }

    private function configureRoutes(ContainerBuilder $builder)
    {
        $builder->addDefinitions(ServiceRoutesDefinitions::get());
    }
}
