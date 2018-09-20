<?php


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