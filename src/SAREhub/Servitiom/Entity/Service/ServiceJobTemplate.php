<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

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
 * @Table(name="service_job_definitions",
 *        uniqueConstraints={@UniqueConstraint(name="unique_job_template",columns={"name", "scopeType", "serviceVersion"})}
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
    private $scopeType;

    /**
     * @ManyToOne(targetEntity="ServiceVersion")
     * @JoinColumn(onDelete="CASCADE")
     * @var ServiceVersion
     */
    private $serviceVersion;

    /**
     * @Column(type="integer", options={"unsigned": true})
     * @var int
     */
    private $createdAt;

    /**
     * @Column(type="text", length=65535)
     * @var string
     */
    private $template;
}