<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php");

$theBugId = 7;

$bug = $entityManager->find("Model_Bug", (int)$theBugId);

echo "Model_Bug: " . $bug->getDescription() . "\n";
echo "Engineer: " . $bug->getEngineer()->getName() . "\n";
