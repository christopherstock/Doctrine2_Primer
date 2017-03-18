<?php
/**
 * All doctrine 2 example actions for the 'bug' entity.
 */
class Example_Bug
{

    /**
     * Inserts a new bug into the database.
     */
    public static function create()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        $reporterId = 1;
        $engineerId = 2;
        $productIds = array( 3, 4, 5, );

        /** @var Model_User $reporter */
        $reporter = $entityManager->find("Model_User", $reporterId);

        /** @var Model_User $engineer */
        $engineer = $entityManager->find("Model_User", $engineerId);

        if (!$reporter) {
            Service_Console::log('<b>Non existing reporter id [' . $reporterId . ']</b>', Service_Console::COLOR_RED);
            Service_Console::log();
            Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
            return;
        }

        if (!$engineer) {
            Service_Console::log('<b>Non existing engineer id [' . $engineerId . ']</b>', Service_Console::COLOR_RED);
            Service_Console::log();
            Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
            return;
        }

        $bug = new Model_Bug();
        $bug->setDescription("Something does not work!");
        $bug->setCreated(new DateTime("now"));
        $bug->setStatus("OPEN");

        foreach ($productIds as $productId) {

            /** @var Model_Product $product */
            $product = $entityManager->find("Model_Product", $productId);

            if (!$product) {
                Service_Console::log('<b>Non existing product id [' . $productId . ']</b>', Service_Console::COLOR_RED);
                Service_Console::log();
                Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
                return;
            }

            $bug->assignToProduct($product);
        }

        $bug->setReporter( $reporter );
        $bug->setEngineer( $engineer );

        $entityManager->persist($bug);
        $entityManager->flush();

        Service_Console::log('Bug was created with id [' . $bug->getId() . ']');
        Service_Console::log();

        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

    /**
     * Shows all bugs with their according products.
     */
    public static function showOpenBugsWithProducts()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        Service_Console::log('Listing all OPEN Bugs with their according products');
        Service_Console::log();

        $dql = '
            SELECT
                p.id,
                p.name,
                COUNT(b.id) AS openBugs
            FROM
                Model_Bug AS b
            JOIN
                b.products AS p
            WHERE
                b.status = \'OPEN\'
            GROUP BY
                p.id
        ';
        $productBugs = $entityManager->createQuery( $dql )->getScalarResult();

        foreach ($productBugs as $productBug) {
            Service_Console::log(
                'Model_Product id ['
                . $productBug['id']
                . '] name ['
                . $productBug['name']
                . '] has ['
                . $productBug['openBugs']
                . '] open bugs.'
            );
        }

        Service_Console::log();
        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

}