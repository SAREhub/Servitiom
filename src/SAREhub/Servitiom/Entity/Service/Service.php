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
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="services")
 **/
class Service
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
     *
     * @Column(type="string", length=512, options={"default":""})
     * @var string
     */
    private $description;

    /**
     * @Column(type="integer", options={"unsigned": true})
     * @var int
     */
    private $createdAt;

    /**
     * @OneToOne(targetEntity="ServiceVersion")
     * @JoinColumn(nullable=true)
     * @var ServiceVersion
     */
    private $defaultVersion;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Service
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Service
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    public function setCreatedAt(int $createdAt): Service
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getDefaultVersion(): ServiceVersion
    {
        return $this->defaultVersion;
    }

    public function setDefaultVersion(ServiceVersion $defaultVersion): Service
    {
        $this->defaultVersion = $defaultVersion;
        return $this;
    }
}