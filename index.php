<?php
/**
 *  TODO ASAP Refactor all doctrine2-scripts to php classes.
 *  TODO ASAP Refactor: Remove redundancies in the action system!
 *  TODO ASAP Refactor: Cleaner separation of calculation and output?
 */
    require_once( "vendor/autoload.php" );

    Service_Action::acclaim();

    $actionToPerform = Service_Action::getActionIdToPerform();
    Service_Action::perform($actionToPerform);
