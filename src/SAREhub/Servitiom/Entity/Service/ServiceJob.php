<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace Servitiom\Entity\Service;


use SAREhub\Servitiom\Entity\Service\ServiceJobTemplate;
use Servitiom\Entity\Job\Job;

class ServiceJob
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var ServiceJobTemplate
     */
    private $templateId;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @var int
     */
    private $updatedAt;

    private $state;

    /**
     * @var string
     */
    private $currentTaskId;

    /**
     * @var Job
     */
    private $currentTaskJob;
}