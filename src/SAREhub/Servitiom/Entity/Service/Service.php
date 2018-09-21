<?php


namespace SAREhub\Servitiom\Entity\Service;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use SAREhub\Servitiom\Entity\Service\Instance\ServiceInstance;

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


}