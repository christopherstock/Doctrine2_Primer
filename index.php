<?php

    require_once( "vendor/autoload.php" );

    Service_Console::log();
    Service_Console::log('Doctrine 2 BAHAG Workshop, v. 0.0.1, (c) 2017 Mayflower GmbH');
    Service_Console::log();

    $actionToPerform = (isset($_GET['action']) ? $_GET['action'] : Service_Action::ACTION_SHOW_MAIN_MENU);
    Service_Action::perform($actionToPerform);

    //$entityManager = service_Doctrine2Bootstrap::createEntityManager();
