<?php
/**
 * Represents the action system.
 */
class Service_Action
{

    const ACTION_SHOW_MAIN_MENU = 0;
    const ACTION_CREATE_USER    = 1;

    /**
     * Performs the specified action.
     *
     * @param int $id The id of the action to perform.
     */
    public static function perform($id)
    {
        switch ($id) {

            case self::ACTION_SHOW_MAIN_MENU:
            {
                Service_Console::log('<a href="?action=' . self::ACTION_CREATE_USER . '">Create User</a>');

                break;
            }

            case self::ACTION_CREATE_USER:
            {
                Doctrine_User::create();

                break;
            }
        }
    }

}