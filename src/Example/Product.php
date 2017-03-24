<?php
/**
 * All doctrine 2 example actions for the 'product' entity.
 */
class Example_Product
{

    /**
     * Inserts a new product into the database.
     */
    public static function create()
    {
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        $newProductName = 'New Product at ' . date('Y-m-d H:i:s', time());

        Service_Console::log();
        Service_Console::log('Creating a new product with productname [' . $newProductName . '] into the database..');
        Service_Console::log();

        $newProduct = new Model_Product();
        $newProduct->setName($newProductName);

        $entityManager->persist($newProduct);
        $entityManager->flush();

        Service_Console::log(
            '<b>Successfully created new product with ID ' . $newProduct->getId() . '.</b>',
            Service_Console::COLOR_GREEN
        );
        Service_Console::log();

        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

    /**
     * Finds a product by it's id.
     */
    public static function findById()
    {
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        $productId = 4;

        Service_Console::log();
        Service_Console::log('Finding Product by id [' . $productId . '] ..');
        Service_Console::log();

        /** @var Model_Product $product */
        $product = $entityManager->find('Model_Product', $productId);

        Service_Console::log('<b>Product id [' . $product->getId() . '] name [' . $product->getName() . ']</b>', Service_Console::COLOR_GREEN);
        Service_Console::log();

        // show main menu
        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

    /**
     * Finds a product by it's name.
     */
    public static function findByName()
    {
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        $productName = 'newName for product3';

        Service_Console::log();
        Service_Console::log('Finding Product by name [' . $productName . '] ..');
        Service_Console::log();

        /** @var Model_Product $product */
        $product = $entityManager->getRepository('Model_Product')->findOneBy(
            array(
                'name' => $productName,
            )
        );

        Service_Console::log('<b>Product id [' . $product->getId() . '] name [' . $product->getName() . ']</b>', Service_Console::COLOR_GREEN);
        Service_Console::log();

        // show main menu
        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

    /**
     * Lists all products.
     */
    public static function findAll()
    {
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        Service_Console::log();
        Service_Console::log('Listing all Products:');
        Service_Console::log();

        // get all products
        $productRepository = $entityManager->getRepository('Model_Product');

        /** @var Model_Product[] $products */
        $products = $productRepository->findAll();

        foreach ($products as $product) {
            Service_Console::log('<b>Product id [' . $product->getId() . '] name [' . $product->getName() . ']</b>', Service_Console::COLOR_GREEN);
        }
        Service_Console::log();

        // show main menu
        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

    /**
     * Alters the name of a specific product.
     */
    public static function updateProductName()
    {
        $entityManager = Service_Doctrine2Bootstrap::createEntityManager();

        $productId = 3;
        $newName = 'newName for product' . $productId;

        Service_Console::log();
        Service_Console::log('Updating name for Product id [' . $productId . '] to [' . $newName . '] ..');
        Service_Console::log();

        /** @var Model_Product $product */
        $product = $entityManager->find('Model_Product', $productId);

        $product->setName($newName);

        $entityManager->flush();

        Service_Console::log('<b>Updated name for product with id [' . $product->getId() . '] to [' . $product->getName() . ']</b>', Service_Console::COLOR_GREEN);
        Service_Console::log();

        // show main menu
        Service_Action::perform(Service_Action::ACTION_0_SHOW_MAIN_MENU);
    }

}