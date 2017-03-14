<?php

    require_once( "vendor/autoload.php" );

    service_Console::log();
    service_Console::log('Doctrine 2 BAHAG Workshop, v. 0.0.1, (c) 2017 Mayflower GmbH');

    $entityManager = service_Doctrine2Bootstrap::createEntityManager();




