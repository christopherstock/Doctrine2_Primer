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

        Service_Console::log('Creating a new Bug for reporter [' . $reporterId . '] and engineer [' . $engineerId . '] ..');

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

        Service_Console::log('<b>Bug was created with id [' . $bug->getId() . ']</b>', Service_Console::COLOR_GREEN);
        Service_Console::log();

        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

    /**
     * Finds a specific bug by id.
     */
    public static function findById()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        $bugId = 7;
        Service_Console::log('Retreiving Bug by id [' . $bugId . '] ..');

        /** @var Model_Bug $bug */
        $bug = $entityManager->find("Model_Bug", $bugId);

        Service_Console::log(
            'Bug id ['
            . $bug->getId()
            . '] description ['
            . $bug->getDescription()
            . '] reporter name ['
            . $bug->getReporter()->getName()
            . '] assignee name ['
            . $bug->getEngineer()->getName() . ']'
        );
        Service_Console::log();

        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

    /**
     * Shows all bugs with the specified status.
     */
    public static function findByStatus()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        $status = 'CLOSE';
        Service_Console::log('Retreiving Bugs by status [' . $status . '] ..');
        Service_Console::log();

        /** @var Model_Bug[] $bugs */
        $bugs = $entityManager->getRepository('Model_Bug')->findBy(
            array(
                'status' => $status,
            )
        );
        Service_Console::log('found [' . count($bugs) . '] bugs with status [' . $status . ']:');
        Service_Console::log();

        foreach ($bugs as $bug) {
            Service_Console::log(
                'Bug id ['
                . $bug->getId()
                . '] description ['
                . $bug->getDescription()
                . '] reporter name ['
                . $bug->getReporter()->getName()
                . '] assignee name ['
                . $bug->getEngineer()->getName() . ']'
            );
        }
        Service_Console::log();

        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

    /**
     * Shows all bugs using doctrine models.
     */
    public static function showAllUsingModels()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        Service_Console::log('Listing all Bugs:');

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
            Service_Console::log('Bug id [' . $bug->getId() . ']');
            Service_Console::log('    description [' . $bug->getDescription() . ']');
            Service_Console::log('    created     [' . $bug->getCreated()->format('d.m.Y H:i:s') . "]");
            Service_Console::log('    reported by [' . $bug->getReporter()->getName() . ']');
            Service_Console::log('    assigned to [' . $bug->getEngineer()->getName() . ']');
            Service_Console::log('    status      [' . $bug->getStatus() . "]");
            foreach ($bug->getProducts() as $product) {
                Service_Console::log('        product id [' . $product->getId() . '] name [' . $product->getName() . ']');
            }
        }

        Service_Console::log();
        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

    /**
     * Shows all bugs using arrays.
     */
    public static function showAllUsingArrays()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        Service_Console::log('Listing all Bugs:');

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
            Service_Console::log('Bug id [' . $bug['id'] . ']');
            Service_Console::log('    description [' . $bug['description'] . ']');
            Service_Console::log('    created     [' . $bug['created']->format('d.m.Y H:i:s') . "]");
            Service_Console::log('    reported by [' . $bug['reporter']['name'] . ']');
            Service_Console::log('    assigned to [' . $bug['engineer']['name'] . ']');
            Service_Console::log('    status      [' . $bug['status'] . "]");
            foreach ($bug['products'] as $product) {
                Service_Console::log('        product id [' . $product['id'] . '] name [' . $product['name'] . ']');
            }
        }

        Service_Console::log();
        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

    /**
     * Shows all bugs using own repository class.
     */
    public static function showAllUsingRepository()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        Service_Console::log('Listing all Bugs:');

        /** @var Model_BugRepository $bugRepository */
        $bugRepository = $entityManager->getRepository('Model_Bug');
        $bugs = $bugRepository->getRecentBugs();

        foreach ($bugs as $bug)
        {
            Service_Console::log();
            Service_Console::log('Bug id [' . $bug->getId() . ']');
            Service_Console::log('    description [' . $bug->getDescription() . ']');
            Service_Console::log('    created     [' . $bug->getCreated()->format('d.m.Y H:i:s') . "]");
            Service_Console::log('    reported by [' . $bug->getReporter()->getName() . ']');
            Service_Console::log('    assigned to [' . $bug->getEngineer()->getName() . ']');
            Service_Console::log('    status      [' . $bug->getStatus() . "]");
            foreach ($bug->getProducts() as $product) {
                Service_Console::log('        product id [' . $product->getId() . '] name [' . $product->getName() . ']');
            }
        }

        Service_Console::log();
        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

    /**
     * Shows all open bugs with their according products.
     */
    public static function showOpenBugsWithProducts()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

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

    /**
     * Closes a specific bug.
     */
    public static function close()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        $bugId = 3;

        Service_Console::log('Closing Bug with id [' . $bugId . '] ..');
        Service_Console::log();

        /** @var Model_Bug $bug */
        $bug = $entityManager->find("Model_Bug", $bugId);
        $bug->close();

        $entityManager->flush();

        Service_Console::log('Bug with id [' . $bug->getId() . '] is now in state [' . $bug->getStatus() . '].');

        Service_Console::log();
        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

}