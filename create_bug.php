<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php");

$theReporterId        = 1;
$theDefaultEngineerId = 2;
$productIds           = array( 1, 2, 3, );

/** @var Model_User $reporter */
$reporter = $entityManager->find("Model_User", $theReporterId);

/** @var Model_User $engineer */
$engineer = $entityManager->find("Model_User", $theDefaultEngineerId);

if (!$reporter || !$engineer) {
    echo "No reporter and/or engineer found for the input.\n";
    exit(1);
}

$bug = new Model_Bug();
$bug->setDescription("Something does not work!");
$bug->setCreated(new DateTime("now"));
$bug->setStatus("OPEN");

foreach ($productIds as $productId) {

    /** @var Model_Product $product */
    $product = $entityManager->find("Model_Product", $productId);
    $bug->assignToProduct($product);
}

$bug->setReporter( $reporter );
$bug->setEngineer( $engineer );

$entityManager->persist($bug);
$entityManager->flush();

echo "Your new Model_Bug Id: ".$bug->getId()."\n";
