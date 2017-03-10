<?php
/**
 *  TODO rename table 'bugs' to 'bug'.
 *  TODO Apply team coding style for all sources!
 */

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once( "vendor/autoload.php" );

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(
    array(
        __DIR__ . DIRECTORY_SEPARATOR . 'src',
    ),
    $isDevMode
);

// echo "[" . $config->getProxyDir() . "]<br><br>";

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
