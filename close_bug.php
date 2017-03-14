<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

$theBugId = 3;

$bug = $entityManager->find("Model_Bug", (int)$theBugId);
$bug->close();

$entityManager->flush();

echo 'Model_Bug [' . $theBugId . '] closed';
