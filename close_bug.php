<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

$theBugId = 3;

$bug = $entityManager->find("Bug", (int)$theBugId);
$bug->close();

$entityManager->flush();

echo 'Bug [' . $theBugId . '] closed';
