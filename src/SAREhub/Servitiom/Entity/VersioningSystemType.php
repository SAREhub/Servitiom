<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Entity;

use MyCLabs\Enum\Enum;

class VersioningSystemType extends Enum
{
    public const SEMANTIC_2 = "SEMANTIC_2";
    public const GIT_COMMIT = "GIT_COMMIT";
    public const BUILD_TIMESTAMP = "BUILD_TIMESTAMP";
    public const CUSTOM = "CUSTOM";
}