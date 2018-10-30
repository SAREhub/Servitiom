<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Entity\Job;


use MyCLabs\Enum\Enum;

class JobStateType extends Enum
{
    const TODO = "todo";
    const IN_PROGRESS = "in_progress";
    const FAILED = "failed";
    const DONE = "done";
}