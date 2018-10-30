<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Entity\Job;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="jobs")
 **/
class Job
{
    /**
     * @Id
     * @Column(type="integer", options={"unsigned": true})
     * @GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @Column(type="string", length=65535)
     * @var string
     */
    private $payload;

    /**
     * @ManyToOne(targetEntity="SAREhub\Servitiom\Entity\Job\Job")
     * @JoinColumn(onDelete="CASCADE")
     * @var Job
     */
    private $parentJob;

    /**
     * @Column(type="smallint", options={"unsigned": true})
     * @var int
     */
    private $maxRetries;

    /**
     * @Column(type="integer", options={"unsigned": true})
     * @var int
     */
    private $createdAt;

    /**
     * @Embedded(class = "SAREhub\Servitiom\Entity\Job\JobStatus")
     */
    private $status;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Job
    {
        $this->id = $id;
        return $this;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }

    public function setPayload(string $payload): Job
    {
        $this->payload = $payload;
        return $this;
    }

    public function getParentJob(): Job
    {
        return $this->parentJob;
    }

    public function setParentJob(Job $parentJob): Job
    {
        $this->parentJob = $parentJob;
        return $this;
    }

    public function getMaxRetries(): int
    {
        return $this->maxRetries;
    }

    public function setMaxRetries(int $maxRetries): Job
    {
        $this->maxRetries = $maxRetries;
        return $this;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    public function setCreatedAt(int $createdAt): Job
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}