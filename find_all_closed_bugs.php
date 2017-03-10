<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

/** @var Bug[] $bugs */
$bugs = $entityManager->getRepository('Bug')
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
