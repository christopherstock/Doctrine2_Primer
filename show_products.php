<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

$dql = "SELECT p.id, p.name, count(b.id) AS openBugs FROM Bug b JOIN b.products p WHERE b.status = 'OPEN' GROUP BY p.id";
$productBugs = $entityManager->createQuery( $dql )->getScalarResult();

foreach ( $productBugs as $productBug ) {
    echo '<pre>';
    echo 'Product id [' . $productBug['id'] . '] name [' . $productBug['name'] . "] has [" . $productBug['openBugs'] . "] open bugs!\n";
    echo '</pre>';
}
