<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Util\Database;


use Acelaya\Doctrine\Type\PhpEnumType;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use SAREhub\Commons\Task\Task;
use SAREhub\MicroORM\DatabaseException;

class EnumTypeMappingRegisterTask implements Task
{
    /**
     * @var array
     */
    private $types;

    /**
     * @var AbstractPlatform
     */
    private $platform;

    public function __construct(array $types, AbstractPlatform $platform)
    {
        $this->types = $types;
        $this->platform = $platform;
    }

    public function run()
    {
        foreach ($this->types as $type) {
            $this->registerType($type);
        }
    }

    private function registerType(string $type)
    {
        try {
            PhpEnumType::registerEnumType($type);
            $this->platform->registerDoctrineTypeMapping("VARCHAR", $type);
        } catch (DBALException $e) {
            throw DatabaseException::createFromDBAL($e, "registering enum type: $type");
        }
    }
}