<?php
/**
 *  TODO ASAP Refactor all doctrine2-scripts to php classes.
 *  TODO ASAP Move all batch-scripts to separate directory 'bin' etc.
 *  TODO INIT Refactor Service_Doctrine2Bootstrap - Create separate methods for creating config and connection.
 */
    // include autoloader
    require_once( "vendor/autoload.php" );

    // output project title
    Service_Action::acclaim();

    // pick action from get parameter and perform it
    $actionToPerform = (isset($_GET['action']) ? $_GET['action'] : Service_Action::ACTION_SHOW_MAIN_MENU);
    Service_Action::perform($actionToPerform);
