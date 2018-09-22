<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

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