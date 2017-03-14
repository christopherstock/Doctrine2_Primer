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
        Service_Console::log('Bootstrapping the Doctrine 2 Framework.');

        // Create a simple "default" Doctrine ORM configuration for Annotations
        $config = Setup::createAnnotationMetadataConfiguration(
            array(
                __DIR__
                . DIRECTORY_SEPARATOR
                . '..'
                . DIRECTORY_SEPARATOR
                . 'model'
            ),
            self::IS_DEV_MODE
        );

        // database configuration parameters
        $conn = array(
            'host'     => 'localhost',
            'user'     => 'root',
            'password' => 'bauhaus',
            'driver'   => 'pdo_mysql',
            'dbname'   => 'doctrine2',
        );

        // obtaining the entity manager
        $entityManager = EntityManager::create($conn, $config);

        Service_Console::log('Succeeded.', Service_Console::COLOR_GREEN);
        Service_Console::log();

        return $entityManager;
    }

}