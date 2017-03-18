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

    /**
     * Shows the user's dashboard with all open bugs.
     */
    public static function showDashboard()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        $userId = 1;

        Service_Console::log('Showing the User Dashboard for User with id [' . $userId . ']');
        Service_Console::log();

        $dql = '
            SELECT
                b,
                e,
                r
            FROM
                Model_Bug AS b
            JOIN
                b.engineer AS e
            JOIN
                b.reporter AS r
            WHERE
                    b.status = \'OPEN\'
                AND (e.id = ?1 OR r.id = ?1)
            ORDER BY
                b.created DESC
        ';

        /** @var Model_Bug[] $bugs */
        $bugs = $entityManager->createQuery($dql)
            ->setParameter(1, $userId)
            ->setMaxResults(15)
            ->getResult();

        Service_Console::log('User with id [' . $userId . '] has reported or is assigned to [' . count($bugs) . '] open Bugs:');
        Service_Console::log();

        foreach ($bugs as $bug) {
            Service_Console::log('    Bug id [' . $bug->getId() . '] description [' . $bug->getDescription() . ']');
        }

        Service_Console::log();
        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

}