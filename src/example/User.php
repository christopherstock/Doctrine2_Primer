<?php
/**
 * All doctrine 2 example actions for the 'user' entity.
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

        $newUser = new Model_User();
        $newUser->setName($newUsername);

        $entityManager->persist($newUser);
        $entityManager->flush();

        Service_Console::log(
            '<b>Successfully created new user with ID ' . $newUser->getId() . '.</b>',
            Service_Console::COLOR_GREEN
        );
        Service_Console::log();

        // show main menu
        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

}