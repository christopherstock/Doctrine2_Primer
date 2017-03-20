<?php
/**
 *  TODO ASAP Prepare knowledge for linking a new project with a git repository!
 *
 *  TODO ASAP Create Workshop Agenda
 *  TODO ASAP Create wiki page with ERD and action descriptions.
 */
    require_once( "vendor/autoload.php" );

    Service_Action::acclaim();

    $actionToPerform = Service_Action::getActionIdToPerform();
    Service_Action::perform($actionToPerform);
