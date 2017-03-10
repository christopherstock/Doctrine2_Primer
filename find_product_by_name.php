<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

$productName = 'MyProduct 1488380715';

/** @var Product $product */
$product = $entityManager->getRepository('Product')
    ->findOneBy(
        array(
            'name' => $productName,
        )
    );

echo 'Product with name ' . $productName . ' has id ' . $product->getId();
