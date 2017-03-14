<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

/** @var Model_Bug[] $bugs */
$bugs = $entityManager->getRepository('Model_Bug')
    ->findBy(
        array(
            'status' => 'CLOSE',
        )
    );

echo 'All closed bugs:';

foreach ($bugs as $bug) {
    echo '<pre>';
    echo 'id: ' . $bug->getId() . ' name: ' . $bug->getDescription();
    echo '</pre>';
}
