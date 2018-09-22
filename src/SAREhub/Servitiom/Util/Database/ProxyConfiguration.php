<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Util\Database;

class ProxyConfiguration
{
    /**
     * @var string
     */
    private $namespace;

    /**
     * @var bool
     */
    private $generateOnFly;

    /**
     * @var string
     */
    private $dir;

    public function __construct(string $namespace, bool $generateOnFly = true, string $dir = "Proxies")
    {
        $this->namespace = $namespace;
        $this->generateOnFly = $generateOnFly;
        $this->dir = $dir;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function isGenerateOnFly(): bool
    {
        return $this->generateOnFly;
    }

    public function getDir(): string
    {
        return $this->dir;
    }


}