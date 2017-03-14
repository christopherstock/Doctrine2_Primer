<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

$productName = 'MyProduct 1488380715';

/** @var Model_Product $product */
$product = $entityManager->getRepository('Model_Product')
    ->findOneBy(
        array(
            'name' => $productName,
        )
    );

echo 'Model_Product with name ' . $productName . ' has id ' . $product->getId();
