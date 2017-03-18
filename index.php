<?php
/**
 *  TODO ASAP Refactor all doctrine2-scripts to php classes.
 *  TODO ASAP Refactor: Remove redundancies in the action system!
 *  TODO ASAP Refactor: Cleaner separation of calculation and output?
 *  TODO ASAP Create class 'ActionMenuItem'
 *  TODO ASAP Create new action 'get entity manager' with debug output (for 1st workshop lesson ..)?
 *  TODO ASAP Create wiki page with ERD and action descriptions.
 *  TODO ASAP Show learning objective(s) after action in main menu and reorder main menu. (Workshop Agenda)
 */
    require_once( "vendor/autoload.php" );

    Service_Action::acclaim();

    $actionToPerform = Service_Action::getActionIdToPerform();
    Service_Action::perform($actionToPerform);
