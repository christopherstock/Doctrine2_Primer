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
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        $reporterId = 1;
        $engineerId = 2;
        $productIds = array( 3, 4, 5, );

        Service_Console::log();
        Service_Console::log(
            'Creating a new Bug for reporter ['
            . $reporterId
            . '], engineer ['
            . $engineerId
            . '] and products ['
            . implode(', ', $productIds) . '] ..');
        Service_Console::log();

        /** @var Model_User $reporter */
        $reporter = $entityManager->find("Model_User", $reporterId);

        /** @var Model_User $engineer */
        $engineer = $entityManager->find("Model_User", $engineerId);

        if (!$reporter) {
            Service_Console::log('<b>Non existing reporter id [' . $reporterId . ']</b>', Service_Console::COLOR_RED);
            Service_Console::log();
            Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
            return;
        }

        if (!$engineer) {
            Service_Console::log('<b>Non existing engineer id [' . $engineerId . ']</b>', Service_Console::COLOR_RED);
            Service_Console::log();
            Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
            return;
        }

        $newBug = new Model_Bug();

        $newBug->setDescription("Something does not work!");
        $newBug->setCreated(new DateTime("now"));
        $newBug->setStatus("OPEN");

        $newBug->setReporter( $reporter );
        $newBug->setEngineer( $engineer );

        foreach ($productIds as $productId) {

            /** @var Model_Product $product */
            $product = $entityManager->find("Model_Product", $productId);

            if (!$product) {
                Service_Console::log('<b>Non existing product id [' . $productId . ']</b>', Service_Console::COLOR_RED);
                Service_Console::log();
                Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
                return;
            }

            $newBug->assignToProduct($product);
        }

        $entityManager->persist($newBug);
        $entityManager->flush();

        Service_Console::log('<b>Bug was created with id [' . $newBug->getId() . ']</b>', Service_Console::COLOR_GREEN);
        Service_Console::log();

        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

    /**
     * Finds a specific bug by id.
     */
    public static function findById()
    {
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        $bugId = 3;
        Service_Console::log();
        Service_Console::log('Retreiving Bug by id [' . $bugId . '] ..');
        Service_Console::log();

        /** @var Model_Bug $bug */
        $bug = $entityManager->find("Model_Bug", $bugId);

        Service_Console::log(
            '<b>Bug id ['
            . $bug->getId()
            . '] description ['
            . $bug->getDescription()
            . '] reporter name ['
            . $bug->getReporter()->getName()
            . '] assignee name ['
            . $bug->getEngineer()->getName()
            . '] product count ['
            . count($bug->getProducts())
            . ']'

            . '</b>',
            Service_Console::COLOR_GREEN
        );

        Service_Console::log();

        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

    /**
     * Shows all bugs with the specified status.
     */
    public static function findByStatus()
    {
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        $status = 'OPEN';
        Service_Console::log();
        Service_Console::log('Retreiving Bugs by status [' . $status . '] ..');
        Service_Console::log();

        /** @var Model_Bug[] $bugs */
        $bugs = $entityManager->getRepository('Model_Bug')->findBy(
            array(
                'status' => $status,
            )
        );
        Service_Console::log('<b>found [' . count($bugs) . '] bugs with status [' . $status . ']:</b>', Service_Console::COLOR_GREEN);
        Service_Console::log();

        foreach ($bugs as $bug) {
            Service_Console::log(
                '<b>Bug id ['
                . $bug->getId()
                . '] description ['
                . $bug->getDescription()
                . '] reporter name ['
                . $bug->getReporter()->getName()
                . '] assignee name ['
                . $bug->getEngineer()->getName() . ']</b>',
                Service_Console::COLOR_GREEN
            );
        }
        Service_Console::log();

        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

    /**
     * Shows all bugs using doctrine models.
     */
    public static function showAllUsingModels()
    {
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        Service_Console::log();
        Service_Console::log('Listing all Bugs via models:');

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
            ORDER BY
                b.created DESC
            ';

        $query = $entityManager->createQuery( $dql );
        $query->setMaxResults( 30 );

        /** @var Model_Bug[] $bugs */
        $bugs = $query->getResult();

        foreach ($bugs as $bug)
        {
            Service_Console::log();
            Service_Console::log('<b>Bug id [' . $bug->getId() . ']</b>', Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    description [' . $bug->getDescription() . ']</b>', Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    created     [' . $bug->getCreated()->format('d.m.Y H:i:s') . "]</b>", Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    reported by [' . $bug->getReporter()->getName() . ']</b>', Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    assigned to [' . $bug->getEngineer()->getName() . ']</b>', Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    status      [' . $bug->getStatus() . "]</b>", Service_Console::COLOR_GREEN);

            // notice that getProducts() triggers a lazy loading here!
            foreach ($bug->getProducts() as $product) {
                Service_Console::log('<b>        product id [' . $product->getId() . '] name [' . $product->getName() . ']</b>', Service_Console::COLOR_GREEN);
            }
        }

        Service_Console::log();
        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

    /**
     * Shows all bugs using arrays.
     */
    public static function showAllUsingArrays()
    {
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        Service_Console::log();
        Service_Console::log('Listing all Bugs via arrays:');

        $dql = '
            SELECT
                b,
                e,
                r,
                p
            FROM
                Model_Bug AS b
            JOIN
                b.engineer AS e
            JOIN
                b.reporter AS r
            JOIN
                b.products AS p
            ORDER BY
                b.created DESC
            ';

        $query = $entityManager->createQuery( $dql );

        /** @var array[] $bugs */
        $bugs = $query->getArrayResult();

        foreach ($bugs as $bug)
        {
            Service_Console::log();
            Service_Console::log('<b>Bug id [' . $bug['id'] . ']</b>', Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    description [' . $bug['description'] . ']</b>', Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    created     [' . $bug['created']->format('d.m.Y H:i:s') . "]</b>", Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    reported by [' . $bug['reporter']['name'] . ']</b>', Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    assigned to [' . $bug['engineer']['name'] . ']</b>', Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    status      [' . $bug['status'] . "]</b>", Service_Console::COLOR_GREEN);
            foreach ($bug['products'] as $product) {
                Service_Console::log('<b>        product id [' . $product['id'] . '] name [' . $product['name'] . ']</b>', Service_Console::COLOR_GREEN);
            }
        }

        Service_Console::log();
        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

    /**
     * Shows all bugs using own repository class.
     */
    public static function showAllUsingRepository()
    {
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        Service_Console::log();
        Service_Console::log('Listing all Bugs via own repository:');

        /** @var Model_BugRepository $bugRepository */
        $bugRepository = $entityManager->getRepository('Model_Bug');
        $bugs = $bugRepository->getRecentBugs();

        foreach ($bugs as $bug)
        {
            Service_Console::log();
            Service_Console::log('<b>Bug id [' . $bug->getId() . ']</b>', Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    description [' . $bug->getDescription() . ']</b>', Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    created     [' . $bug->getCreated()->format('d.m.Y H:i:s') . "]</b>", Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    reported by [' . $bug->getReporter()->getName() . ']</b>', Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    assigned to [' . $bug->getEngineer()->getName() . ']</b>', Service_Console::COLOR_GREEN);
            Service_Console::log('<b>    status      [' . $bug->getStatus() . "]</b>", Service_Console::COLOR_GREEN);
            foreach ($bug->getProducts() as $product) {
                Service_Console::log('<b>        product id [' . $product->getId() . '] name [' . $product->getName() . ']</b>', Service_Console::COLOR_GREEN);
            }
        }

        Service_Console::log();
        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

    /**
     * Shows all products with their open bug count.
     */
    public static function showOpenBugCountForProducts()
    {
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        Service_Console::log();
        Service_Console::log('Listing all OPEN Bugs with their according products:');
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
                '<b>Model_Product id ['
                . $productBug['id']
                . '] name ['
                . $productBug['name']
                . '] has ['
                . $productBug['openBugs']
                . '] open bugs.</b>',
                Service_Console::COLOR_GREEN
            );
        }

        Service_Console::log();
        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

    /**
     * Closes a specific bug.
     */
    public static function close()
    {
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        $bugId = 3;

        Service_Console::log();
        Service_Console::log('Closing Bug with id [' . $bugId . '] ..');
        Service_Console::log();

        /** @var Model_Bug $bug */
        $bug = $entityManager->find("Model_Bug", $bugId);
        $bug->close();

        $entityManager->flush();

        Service_Console::log('<b>Bug with id [' . $bug->getId() . '] is now in state [' . $bug->getStatus() . '].</b>', Service_Console::COLOR_GREEN);

        Service_Console::log();
        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

}