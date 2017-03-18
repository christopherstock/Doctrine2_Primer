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
        $dbConfig = array(
            'host'     => 'localhost',
            'user'     => 'root',
            'password' => '',
            'driver'   => 'pdo_mysql',
            'dbname'   => 'doctrine2',
        );

        $doctrineConfig = Setup::createAnnotationMetadataConfiguration(
            array(
                __DIR__
                . DIRECTORY_SEPARATOR
                . '..'
                . DIRECTORY_SEPARATOR
                . 'model'
            ),
            self::IS_DEV_MODE
        );

        return EntityManager::create($dbConfig, $doctrineConfig);
    }

}