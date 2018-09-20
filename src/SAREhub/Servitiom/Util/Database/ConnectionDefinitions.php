<?php


namespace SAREhub\Servitiom\Util\Database;


use Doctrine\DBAL\Connection;
use SAREhub\MicroORM\Connection\BasicConnectionFactory;
use SAREhub\MicroORM\Connection\ConnectionFactory;
use function DI\autowire;
use function DI\create;
use function DI\env;
use function DI\factory;

class ConnectionDefinitions
{
    const ENV_DATABASE_NAME = "DATABASE_NAME";

    public static function get(): array
    {
        return [
            ConnectionFactory::class => create(BasicConnectionFactory::class),
            ConnectionProvider::class => autowire()
                ->constructorParameter("databaseName", env(self::ENV_DATABASE_NAME, "")),
            Connection::class => factory(ConnectionProvider::class)
        ];
    }
}