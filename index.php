<?php

    require_once( "vendor/autoload.php" );

    Service_Action::acclaim();

    $actionToPerform = Service_Action::getActionIdToPerform();
    Service_Action::perform($actionToPerform);
