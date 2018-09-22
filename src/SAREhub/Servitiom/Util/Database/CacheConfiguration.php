<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Util\Database;


use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\VoidCache;

class CacheConfiguration
{
    /**
     * @var Cache
     */
    private $metadataCache;

    /**
     * @var Cache
     */
    private $queryCache;

    public function __construct(?Cache $metadataCache = null, ?Cache $queryCache = null)
    {
        $this->metadataCache = $metadataCache ?? new VoidCache();
        $this->queryCache = $queryCache ?? new VoidCache();
    }

    public function getMetadataCache(): Cache
    {
        return $this->metadataCache;
    }

    public function getQueryCache(): Cache
    {
        return $this->queryCache;
    }


}