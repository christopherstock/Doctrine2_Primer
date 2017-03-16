<?php
/**
 * Handles all doctrine 2 example actions for the user.
 */
class Example_User
{

    /**
     * Inserts a new user into the database.
     */
    public static function create()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        // insert a new user into the database
        $newUsername = 'MyUser ' . time();

        Service_Console::log('Creating a new user with username [' . $newUsername . '] into the database..');

        $user = new Model_User();
        $user->setName( $newUsername );

        $entityManager->persist( $user );
        $entityManager->flush();

        Service_Console::log(
            '<b>Successfully created new user with ID ' . $user->getId() . '.</b>',
            Service_Console::COLOR_GREEN
        );
        Service_Console::log();
    }

}