<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Handles Doctrine 2 framework bootstrapping.
 */
class Service_Doctrine2Bootstrap
{

    const IS_DEV_MODE = true;

    /**
     * Inits the doctrine 2 framework for the custom data models.
     */
    public static function createEntityManager()
    {
        $dbConfig            = self::getDbConfig();
        $doctrineModelConfig = self::getDoctrineModelConfig();

        return EntityManager::create($dbConfig, $doctrineModelConfig);
    }

    /**
     * @return array
     */
    private static function getDbConfig()
    {
        return array(
            'host'     => 'localhost',
            'user'     => 'root',
            'password' => 'bauhaus',
            'driver'   => 'pdo_mysql',
            'dbname'   => 'doctrine2',
        );
    }

    /**
     * @return \Doctrine\ORM\Configuration
     */
    private static function getDoctrineModelConfig()
    {
        return Setup::createAnnotationMetadataConfiguration(
            array(
                __DIR__
                . DIRECTORY_SEPARATOR
                . '..'
                . DIRECTORY_SEPARATOR
                . 'Model'
            ),
            self::IS_DEV_MODE
        );
    }

}