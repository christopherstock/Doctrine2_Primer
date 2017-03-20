<?php

require_once("../vendor/autoload.php");

$entityManager = Service_Doctrine2Bootstrap::createEntityManager();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
