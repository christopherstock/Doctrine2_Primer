<?php
/**
 *  TODO ASAP Show learning objective(s) after action in main menu and reorder main menu. (Workshop Agenda)
 *  TODO ASAP Create wiki page with ERD and action descriptions.
 *  TODO ASAP Rearrange action constants by their workshop id.
 *  TODO ASAP Prepare knowledge for linking a new project with a git repository!
 */
    require_once( "vendor/autoload.php" );

    Service_Action::acclaim();

    $actionToPerform = Service_Action::getActionIdToPerform();
    Service_Action::perform($actionToPerform);
