<?php
/**
 *  TODO ASAP Refactor all doctrine2-scripts to php classes.
 */
    require_once( "vendor/autoload.php" );

    Service_Action::acclaim();

    // pick action from get parameter and perform it
    $actionToPerform = (isset($_GET['action']) ? $_GET['action'] : Service_Action::ACTION_SHOW_MAIN_MENU);
    Service_Action::perform($actionToPerform);
