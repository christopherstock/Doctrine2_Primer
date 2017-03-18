<?php
/**
 *  TODO ASAP Refactor: Remove redundancies in the action system!
 *  TODO ASAP Refactor: Cleaner separation of calculation and output?
 *  TODO ASAP Create class 'ActionMenuItem'
 *  TODO ASAP Use model ids in model names/descriptions?
 *  TODO ASAP Create new action 'get entity manager' with debug output (for 1st workshop lesson ..)?
 *  TODO ASAP Create wiki page with ERD and action descriptions.
 *  TODO ASAP Prepare knowledge for linking a new project with a git repository.
 *  TODO ASAP Show learning objective(s) after action in main menu and reorder main menu. (Workshop Agenda)
 */
    require_once( "vendor/autoload.php" );

    Service_Action::acclaim();

    $actionToPerform = Service_Action::getActionIdToPerform();
    Service_Action::perform($actionToPerform);
