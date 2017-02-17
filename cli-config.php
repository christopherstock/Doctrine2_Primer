<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php" );

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
