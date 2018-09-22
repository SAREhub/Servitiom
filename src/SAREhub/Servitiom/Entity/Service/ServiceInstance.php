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
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;
use SAREhub\Servitiom\Entity\Tenant\Tenant;

/**
 * @Entity
 * @Table(name="service_instances")
 **/
class ServiceInstance
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @OneToOne(targetEntity="\SAREhub\Servitiom\Entity\Tenant\Tenant")
     * @JoinColumn(onDelete="CASCADE")
     * @var Tenant
     */
    private $tenant;

    /**
     * @ManyToOne(targetEntity="Service")
     * @JoinColumn(onDelete="CASCADE")
     * @var Service
     */
    private $service;

    /**
     * @ManyToOne(targetEntity="ServiceVersion")
     * @JoinColumn(onDelete="CASCADE")
     * @var Service
     */
    private $serviceVersion;

    /**
     * @Column(type="integer", options={"unsigned": true})
     * @var int
     */
    private $createdAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ServiceInstance
    {
        $this->id = $id;
        return $this;
    }

    public function getTenant(): Tenant
    {
        return $this->tenant;
    }

    public function setTenant(Tenant $tenant): ServiceInstance
    {
        $this->tenant = $tenant;
        return $this;
    }

    public function getService(): Service
    {
        return $this->service;
    }

    public function setService(Service $service): ServiceInstance
    {
        $this->service = $service;
        return $this;
    }

    public function getServiceVersion(): Service
    {
        return $this->serviceVersion;
    }

    public function setServiceVersion(Service $serviceVersion): ServiceInstance
    {
        $this->serviceVersion = $serviceVersion;
        return $this;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    public function setCreatedAt(int $createdAt): ServiceInstance
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}