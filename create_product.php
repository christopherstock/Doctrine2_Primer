<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

// insert a product into the database
$newProductName = 'MyProduct ' . time();

$product = new Model_Product();
$product->setName($newProductName);

$entityManager->persist($product);
$entityManager->flush();

echo "Created Model_Product with ID " . $product->getId() . "<br>";
