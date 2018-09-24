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
use Doctrine\DBAL\Types\Type;

class EnumTypeMappingRegistrant
{
    /**
     * @var array
     */
    private $types;

    public function __construct(array $types)
    {
        $this->types = $types;
    }

    /**
     * @param AbstractPlatform $platform
     * @throws DBALException
     */
    public function register(AbstractPlatform $platform): void
    {
        foreach ($this->types as $type) {
            PhpEnumType::registerEnumType($type);
            $platform->registerDoctrineTypeMapping("VARCHAR", $type);
            var_dump(Type::getTypesMap());
        }
    }
}