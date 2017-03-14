<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

// get all products
$productRepository = $entityManager->getRepository('Model_Product');

/** @var Model_Product[] $products */
$products = $productRepository->findAll();

foreach ($products as $product) {
    echo 'id [' . $product->getId() . '] name [' . $product->getName() . ']<br>';
}
