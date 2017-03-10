<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

$theBugId = 7;

$bug = $entityManager->find("Bug", (int)$theBugId);

echo "Bug: " . $bug->getDescription() . "\n";
echo "Engineer: " . $bug->getEngineer()->getName() . "\n";
