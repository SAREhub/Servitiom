<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Entity;


use Acelaya\Doctrine\Type\PhpEnumType;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class TypeMappingRegistrant
{
    /**
     * @param AbstractPlatform $platform
     * @throws DBALException
     */
    public function register(AbstractPlatform $platform): void
    {
        PhpEnumType::registerEnumType(VersioningSystemType::class);
        $platform->registerDoctrineTypeMapping("VARCHAR", VersioningSystemType::class);
    }
}