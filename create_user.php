<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

// insert a new user into the database
$newUsername = 'MyUser ' . time();

$user = new User();
$user->setName( $newUsername );

$entityManager->persist( $user );
$entityManager->flush();

echo "Created User with ID " . $user->getId() . "\n";
