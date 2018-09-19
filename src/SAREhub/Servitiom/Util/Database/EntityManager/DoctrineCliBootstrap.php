<?php


namespace SAREhub\Servitiom\Util\Database\EntityManager;


use Doctrine\DBAL\Platforms\MySQL57Platform;
use Doctrine\ORM\Configuration;

class DoctrineCliBootstrap
{
    /**
     * @var Configuration
     */
    private $config;

    public function bootstrap()
    {
        $cache = new \Doctrine\Common\Cache\ApcuCache();
        $config = new Configuration();
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver("src/SAREhub/Servitiom/Entity");
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir("Proxies");
        $config->setProxyNamespace('SAREhub\\Servitiom\\Proxy');
        $config->setAutoGenerateProxyClasses(false);

        $connectionOptions = array(
            'platform' => new MySQL57Platform(),
            'driver' => "pdo_mysql"
        );
    }
}