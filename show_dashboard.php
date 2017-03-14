<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

$theUserId = 1;

$dql = "SELECT b, e, r FROM Model_Bug b JOIN b.engineer e JOIN b.reporter r WHERE b.status = 'OPEN' AND (e.id = ?1 OR r.id = ?1) ORDER BY b.created DESC";

/** @var Model_Bug[] $myBugs */
$myBugs = $entityManager->createQuery( $dql )
                        ->setParameter( 1, $theUserId )
                        ->setMaxResults( 15 )
                        ->getResult();

echo "You have created or assigned to " . count($myBugs) . " open bugs:\n\n";

foreach ($myBugs as $bug) {
    echo '<pre>';
    echo $bug->getId() . " - " . $bug->getDescription()." - " . $bug->getCreated()->format("Y-m-d H:i:s") . "\n";
    echo '</pre>';
}
