<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

$theReporterId        = 1;
$theDefaultEngineerId = 2;
$productIds           = array( 1, 2, 3, );

/** @var User $reporter */
$reporter = $entityManager->find("User", $theReporterId);

/** @var User $engineer */
$engineer = $entityManager->find("User", $theDefaultEngineerId);

if (!$reporter || !$engineer) {
    echo "No reporter and/or engineer found for the input.\n";
    exit(1);
}

$bug = new Bug();
$bug->setDescription("Something does not work!");
$bug->setCreated(new DateTime("now"));
$bug->setStatus("OPEN");

foreach ($productIds as $productId) {

    /** @var Product $product */
    $product = $entityManager->find("Product", $productId);
    $bug->assignToProduct($product);
}

$bug->setReporter( $reporter );
$bug->setEngineer( $engineer );

$entityManager->persist($bug);
$entityManager->flush();

echo "Your new Bug Id: ".$bug->getId()."\n";
