<?php
/**
 * Represents the action system.
 */
class Service_Action
{

    const ACTION_SHOW_MAIN_MENU = 0;
    const ACTION_CREATE_USER    = 1;
    const ACTION_CREATE_PRODUCT = 2;

    /**
     * Performs the specified action.
     *
     * @param int $id The id of the action to perform.
     */
    public static function perform($id)
    {
        switch ($id) {

            case self::ACTION_SHOW_MAIN_MENU:
                Service_Console::log('Welcome to the main menu. Please choose your action:');
                Service_Console::log();
                Service_Console::log('<a href="?action=' . self::ACTION_CREATE_USER    . '">Create User</a>');
                Service_Console::log('<a href="?action=' . self::ACTION_CREATE_PRODUCT . '">Create Product</a>');
                Service_Console::log();
                break;

            case self::ACTION_CREATE_USER:
                Example_User::create();
                break;

            case self::ACTION_CREATE_PRODUCT:
                Example_Product::create();
                break;
        }
    }

    /**
     * Acclaims the web output.
     */
    public static function acclaim()
    {
        Service_Console::log();
        Service_Console::log('Doctrine 2 BAHAG Workshop, v. 0.0.1, (c) 2017 Mayflower GmbH');
        Service_Console::log('============================================================');
        Service_Console::log();
    }

}