<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

/** @var Model_BugRepository $bugRepository */
$bugRepository = $entityManager->getRepository('Model_Bug');
$bugs = $bugRepository->getRecentBugs();

foreach ($bugs as $bug)
{
    echo '<pre>';
    echo $bug->getDescription()." - ".$bug->getCreated()->format('d.m.Y')."\n";
    echo "    Reported by: ".$bug->getReporter()->getName()."\n";
    echo "    Assigned to: ".$bug->getEngineer()->getName()."\n";
    foreach ($bug->getProducts() as $product) {
        echo "    Platform: ".$product->getName()."\n";
    }
    echo "\n";
    echo '</pre>';
}
