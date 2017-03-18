<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php");

$id = 7;
$newName = 'newName-product';

$product = $entityManager->find('Model_Product', $id);

if ($product === null) {
    echo "Model_Product $id does not exist.\n";
    exit(1);
}

$product->setName($newName);

$entityManager->flush();

echo "Successfully updated product id $id.";
