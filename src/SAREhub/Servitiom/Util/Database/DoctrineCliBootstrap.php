<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Util\Database;


use DI\ContainerBuilder;
use Doctrine\DBAL\Platforms\MySQL57Platform;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use SAREhub\Commons\Logger\EnvLoggingLevelProvider;
use SAREhub\Commons\Logger\StreamLoggerFactoryProvider;
use SAREhub\Commons\Misc\EnvironmentHelper;
use SAREhub\Commons\Secret\SecretValueProvider;
use SAREhub\Commons\Secret\SimpleSecretValueProvider;
use SAREhub\MicroORM\Connection\ConnectionOptions;
use SAREhub\MicroORM\Connection\MySQLEnvConnectionOptionsProvider;
use SAREhub\MicroORM\Entity\EntityManager;
use SAREhub\Servitiom\Entity\EntityManagerDefinitions;
use SAREhub\Servitiom\Util\ErrorHandling;
use function DI\create;
use function DI\factory;

class DoctrineCliBootstrap
{
    public static function run()
    {
        $logger = self::createLogger();
        try {
            ErrorHandling::setup();
            $container = self::buildContainer($logger);
            $helperSet = ConsoleRunner::createHelperSet($container->get(EntityManager::class));
            ConsoleRunner::createApplication($helperSet)->run();
        } catch (\Throwable $e) {
            $logger->critical("Error occur: " . $e->getMessage(), ["exception" => $e]);
            exit(1);
        }
    }

    private static function createLogger(): LoggerInterface
    {
        $loggingLevel = (new EnvLoggingLevelProvider())->get();
        $factory = (new StreamLoggerFactoryProvider($loggingLevel, null))->get();
        return $factory->create("DoctrineCliBootstrap");
    }

    /**
     * @return ContainerInterface
     * @throws \Exception
     */
    private static function buildContainer(LoggerInterface $logger): ContainerInterface
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->useAnnotations(true);
        $containerBuilder->useAutowiring(true);
        if (EnvironmentHelper::getVar("DOCTRINE_CLI_USE_CONNECTION")) {
            $logger->info("using real database");
            $containerBuilder->addDefinitions([
                ConnectionOptions::class => factory(MySQLEnvConnectionOptionsProvider::class),
                SecretValueProvider::class => create(SimpleSecretValueProvider::class)
            ]);
        } else {
            $containerBuilder->addDefinitions([
                ConnectionOptions::class => new ConnectionOptions([
                    "driver" => "pdo_mysql",
                    "platform" => new MySQL57Platform()
                ])
            ]);
        }

        $containerBuilder->addDefinitions(EntityManagerDefinitions::get());
        $containerBuilder->addDefinitions(ConnectionDefinitions::get());
        return $containerBuilder->build();
    }
}