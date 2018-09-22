<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Util;

use SAREhub\Commons\Secret\SecretValueProvider;
use SAREhub\DockerUtil\Secret\DockerSecretValueProvider;
use function DI\autowire;

class UtilDefinitions
{
    public static function get(): array
    {
        return [
            SecretValueProvider::class => autowire(DockerSecretValueProvider::class)
        ];
    }
}