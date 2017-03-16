<?php
/**
 * All doctrine 2 example actions for the product.
 */
class Example_Product
{

    /**
     * Inserts a new user into the database.
     */
    public static function create()
    {
        $entityManager = service_Doctrine2Bootstrap::createEntityManager();

        // insert a product into the database
        $newProductName = 'MyProduct ' . time();

        Service_Console::log('Creating a new product with productname [' . $newProductName . '] into the database..');

        $newProduct = new Model_Product();
        $newProduct->setName($newProductName);

        $entityManager->persist($newProduct);
        $entityManager->flush();

        Service_Console::log(
            '<b>Successfully created new product with ID ' . $newProduct->getId() . '.</b>',
            Service_Console::COLOR_GREEN
        );
        Service_Console::log();

        // show main menu
        Service_Action::perform(Service_Action::ACTION_SHOW_MAIN_MENU);
    }

}