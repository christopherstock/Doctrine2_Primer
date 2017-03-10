<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

$dql = "SELECT b, e, r, p FROM Bug AS b JOIN b.engineer e JOIN b.reporter r JOIN b.products p ORDER BY b.created DESC";
$query = $entityManager->createQuery($dql);

/** @var array[] $bugs */
$bugs = $query->getArrayResult();

foreach ( $bugs as $bug )
{
    echo '<pre>';
    echo $bug['description'] . " - " . $bug['created']->format('d.m.Y H:i:s')."\n";
    echo "    Reported by: ".$bug['reporter']['name']."\n";
    echo "    Assigned to: ".$bug['engineer']['name']."\n";
    foreach ($bug['products'] as $product) {
        echo "    Platform: ".$product['name']."\n";
    }
    echo '</pre>';
}
