<?php


namespace SAREhub\Servitiom\Util\Database;


use DI\ContainerBuilder;
use Doctrine\DBAL\Platforms\MySQL57Platform;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use SAREhub\Commons\Logger\EnvLoggingLevelProvider;
use SAREhub\Commons\Logger\StreamLoggerFactoryProvider;
use SAREhub\MicroORM\Connection\ConnectionOptions;
use SAREhub\MicroORM\Entity\EntityManager;
use SAREhub\Servitiom\Util\ErrorHandling;

class DoctrineCliBootstrap
{
    public static function run()
    {
        $logger = self::createLogger();
        try {
            ErrorHandling::setup();
            $container = self::buildContainer();
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
    private static function buildContainer(): ContainerInterface
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->useAnnotations(true);
        $containerBuilder->useAutowiring(true);
        $connectionOptions = new ConnectionOptions([
            "driver" => "pdo_mysql",
            "platform" => new MySQL57Platform()
        ]);

        $containerBuilder->addDefinitions([
            ConnectionOptions::class => $connectionOptions
        ]);
        $containerBuilder->addDefinitions(ConnectionDefinitions::get());
        $containerBuilder->addDefinitions(EntityManagerDefinitions::get());
        return $containerBuilder->build();
    }
}