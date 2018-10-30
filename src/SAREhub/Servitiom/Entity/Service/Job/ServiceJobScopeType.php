<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Entity\Service\Job;


use MyCLabs\Enum\Enum;

class ServiceJobScopeType extends Enum
{
    const SERVICE = "service";
    const INSTANCE = "instance";
}