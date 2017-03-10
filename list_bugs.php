<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

$dql = 'SELECT b, e, r FROM Bug AS b JOIN b.engineer AS e JOIN b.reporter AS r ORDER BY b.created DESC';

$query = $entityManager->createQuery( $dql );
$query->setMaxResults( 30 );

/** @var Bug[] $bugs */
$bugs = $query->getResult();

foreach ($bugs as $bug)
{
    echo '<pre>';
    echo $bug->getDescription()." - ".$bug->getCreated()->format('d.m.Y H:i:s')."\n";
    echo "    Id: ".$bug->getId()."\n";
    echo "    Reported by: ".$bug->getReporter()->getName()."\n";
    echo "    Assigned to: ".$bug->getEngineer()->getName()."\n";
    echo "    Status: ".$bug->getStatus()."\n";
    foreach ($bug->getProducts() as $product) {
        echo "    Platform: ".$product->getName()."\n";
    }
    echo '</pre>';
}
