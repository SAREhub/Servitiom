<?php


namespace SAREhub\Servitiom\Entity\Tenant;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="tenants")
 **/
class Tenant
{
    /**
     * @Id
     * @Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Tenant
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Tenant
    {
        $this->name = $name;
        return $this;
    }

}