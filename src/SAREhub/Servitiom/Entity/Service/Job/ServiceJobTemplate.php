<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Entity\Service\Job;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;
use SAREhub\Servitiom\Entity\Service\ServiceVersion;

/**
 * @Entity
 * @Table(
 *     name="service_job_definitions",
 *     uniqueConstraints={@UniqueConstraint(name="unique_job_template",columns={"name", "scopeType", "serviceVersion"})}
 * )
 **/
class ServiceJobTemplate
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @Column(type=ServiceJobScopeType::class, length=255)
     * @var ServiceJobScopeType
     */
    private $scopeType;

    /**
     * @ManyToOne(targetEntity="SAREhub\Servitiom\Entity\Service\ServiceVersion")
     * @JoinColumn(onDelete="CASCADE")
     * @var ServiceVersion
     */
    private $serviceVersion;

    /**
     * @Column(type="text", length=65535)
     * @var string
     */
    private $template;

    /**
     * @Column(type="integer", options={"unsigned": true})
     * @var int
     */
    private $createdAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ServiceJobTemplate
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ServiceJobTemplate
    {
        $this->name = $name;
        return $this;
    }

    public function getScopeType(): ServiceJobScopeType
    {
        return $this->scopeType;
    }

    public function setScopeType(ServiceJobScopeType $scopeType): ServiceJobTemplate
    {
        $this->scopeType = $scopeType;
        return $this;
    }

    public function getServiceVersion(): ServiceVersion
    {
        return $this->serviceVersion;
    }

    public function setServiceVersion(ServiceVersion $serviceVersion): ServiceJobTemplate
    {
        $this->serviceVersion = $serviceVersion;
        return $this;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template): ServiceJobTemplate
    {
        $this->template = $template;
        return $this;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    public function setCreatedAt(int $createdAt): ServiceJobTemplate
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}