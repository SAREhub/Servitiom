<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Entity\Service;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @Entity
 * @Table(name="service_versions",
 *        uniqueConstraints={@UniqueConstraint(name="unique_version",columns={"service", "versionString"})}
 * )
 **/
class ServiceVersion
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Service")
     * @JoinColumn(onDelete="CASCADE")
     * @var Service
     */
    private $service;

    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $versionString;

    /**
     * @Column(type="integer", options={"unsigned": true})
     * @var int
     */
    private $createdAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ServiceVersion
    {
        $this->id = $id;
        return $this;
    }

    public function getService(): Service
    {
        return $this->service;
    }

    public function setService(Service $service): ServiceVersion
    {
        $this->service = $service;
        return $this;
    }

    public function getVersionString(): string
    {
        return $this->versionString;
    }

    public function setVersionString(string $versionString): ServiceVersion
    {
        $this->versionString = $versionString;
        return $this;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    public function setCreatedAt(int $createdAt): ServiceVersion
    {
        $this->createdAt = $createdAt;
        return $this;
    }

}