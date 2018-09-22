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
use SAREhub\Servitiom\Entity\VersioningSystemType;

/**
 * @Entity
 * @Table(name="service_versions")
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
     * @Column(type="VersioningSystemType::class")
     * @var VersioningSystemType
     */
    private $versioningSystemType;

    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $value;

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

    public function getVersioningSystemType(): VersioningSystemType
    {
        return $this->versioningSystemType;
    }

    public function setVersioningSystemType(VersioningSystemType $versioningSystemType): ServiceVersion
    {
        $this->versioningSystemType = $versioningSystemType;
        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): ServiceVersion
    {
        $this->value = $value;
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