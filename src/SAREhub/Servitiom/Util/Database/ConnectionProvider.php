<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Util\Database;


use SAREhub\Commons\Misc\InvokableProvider;
use SAREhub\MicroORM\Connection\ConnectionFactory;
use SAREhub\MicroORM\Connection\ConnectionOptions;

class ConnectionProvider extends InvokableProvider
{

    /**
     * @var ConnectionFactory
     */
    private $factory;

    /**
     * @var ConnectionOptions
     */
    private $options;

    /**
     * @var string
     */
    private $databaseName;

    public function __construct(ConnectionFactory $factory, ConnectionOptions $options, string $databaseName = "")
    {
        $this->factory = $factory;
        $this->options = $options;
        $this->databaseName = $databaseName;
    }

    public function get()
    {
        return $this->factory->create($this->options, $this->databaseName);
    }
}