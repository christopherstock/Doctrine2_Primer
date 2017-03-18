<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php");

$id = 7;
$product = $entityManager->find('Model_Product', $id);

if ($product === null) {
    echo "No product found.\n";
    exit(1);
}

    echo 'id [' . $product->getId() . '] name [' . $product->getName() . ']<br>';
