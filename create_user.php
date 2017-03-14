<?php

    require_once( "vendor/autoload.php" );
    $entityManager = service_Doctrine2Bootstrap::createEntityManager();

    // insert a new user into the database
    $newUsername = 'MyUser ' . time();

    $user = new Model_User();
    $user->setName( $newUsername );

    $entityManager->persist( $user );
    $entityManager->flush();

    Service_Console::log('Created Model_User with ID ' . $user->getId());
