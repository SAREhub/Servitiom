<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace Servitiom\Entity\Job;


class Job
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $payload;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var string
     */
    private $queue;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var int
     */
    private $ttr;

    private $state;

    /**
     * @var string
     */
    private $internalJobId;
}