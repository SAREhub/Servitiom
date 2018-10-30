<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Entity\Job;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

/**
 * @Embeddable
 */
class JobStatus
{

    /**
     * @Column(type="integer", options={"unsigned": true})
     * @var int
     */
    private $updatedAt;

    /**
     * @Column(type=JobState::class, length=255)
     * @var JobStateType
     */
    private $state;

    /**
     * @Column(type="smallint", options={"unsigned": true})
     * @var int
     */
    private $retries;

    /**
     * @Column(type="json", length=65535)
     * @var array
     */
    private $data;
}