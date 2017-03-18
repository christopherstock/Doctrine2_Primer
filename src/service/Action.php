<?php
/**
 * Represents the action system.
 */
class Service_Action
{

    const ACTION_SHOW_MAIN_MENU               = 0;
    const ACTION_CREATE_USER                  = 1;
    const ACTION_CREATE_PRODUCT               = 2;
    const ACTION_CREATE_BUG                   = 3;
    const ACTION_FIND_BUG_BY_ID               = 4;
    const ACTION_FIND_BUGS_BY_STATUS          = 5;
    const ACTION_FIND_PRODUCT_BY_ID           = 6;
    const ACTION_FIND_PRODUCT_BY_NAME         = 7;
    const ACTION_SHOW_ALL_PRODUCTS            = 8;
    const ACTION_SHOW_ALL_BUGS_MODELS         = 9;
    const ACTION_SHOW_ALL_BUGS_ARRAYS         = 10;
    const ACTION_SHOW_ALL_BUGS_REPOSITORY     = 11;
    const ACTION_SHOW_OPEN_BUGS_WITH_PRODUCTS = 12;
    const ACTION_ALTER_PRODUCT_NAME           = 13;
    const ACTION_CLOSE_BUG                    = 14;
    const ACTION_SHOW_USER_DASHBOARD          = 15;

    /**
     * Performs the specified action.
     *
     * @param int $id The id of the action to perform.
     */
    public static function perform($id)
    {
        switch ($id) {

            case self::ACTION_SHOW_MAIN_MENU:
                self::showMainMenu();
                break;

            case self::ACTION_CREATE_USER:
                Example_User::create();
                break;

            case self::ACTION_CREATE_PRODUCT:
                Example_Product::create();
                break;

            case self::ACTION_CREATE_BUG:
                Example_Bug::create();
                break;

            case self::ACTION_FIND_BUG_BY_ID:
                Example_Bug::findById();
                break;

            case self::ACTION_FIND_BUGS_BY_STATUS:
                Example_Bug::findByStatus();
                break;

            case self::ACTION_FIND_PRODUCT_BY_ID:
                Example_Product::findById();
                break;

            case self::ACTION_FIND_PRODUCT_BY_NAME:
                Example_Product::findByName();
                break;

            case self::ACTION_SHOW_ALL_PRODUCTS:
                Example_Product::showAll();
                break;

            case self::ACTION_SHOW_ALL_BUGS_MODELS:
                Example_Bug::showAllUsingModels();
                break;

            case self::ACTION_SHOW_ALL_BUGS_ARRAYS:
                Example_Bug::showAllUsingArrays();
                break;

            case self::ACTION_SHOW_ALL_BUGS_REPOSITORY:
                Example_Bug::showAllUsingRepository();
                break;

            case self::ACTION_SHOW_OPEN_BUGS_WITH_PRODUCTS:
                Example_Bug::showOpenBugsWithProducts();
                break;

            case self::ACTION_ALTER_PRODUCT_NAME:
                Example_Product::updateProductName();
                break;

            case self::ACTION_CLOSE_BUG:
                Example_Bug::close();
                break;

            case self::ACTION_SHOW_USER_DASHBOARD:
                Example_User::showDashboard();
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

    /**
     * @return int
     */
    public static function getActionIdToPerform()
    {
        if (isset($_GET['action'])) {
            return $_GET['action'];
        } else {
            return Service_Action::ACTION_SHOW_MAIN_MENU;
        }
    }

    /**
     * @return void
     */
    private static function showMainMenu()
    {
        Service_Console::log('Welcome to the main menu. Please choose your action:');

        Service_Console::log();
        Service_Console::log('<a href="?action=' . self::ACTION_CREATE_USER                  . '">Create User</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_CREATE_PRODUCT               . '">Create Product</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_CREATE_BUG                   . '">Create Bug</a>');
        Service_Console::log();
        Service_Console::log('<a href="?action=' . self::ACTION_FIND_BUG_BY_ID               . '">Find Bug by id</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_FIND_BUGS_BY_STATUS          . '">Find Bugs by status</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_FIND_PRODUCT_BY_ID           . '">Find Product by id</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_FIND_PRODUCT_BY_NAME         . '">Find Product by name</a>');
        Service_Console::log();
        Service_Console::log('<a href="?action=' . self::ACTION_SHOW_ALL_PRODUCTS            . '">Show all Products</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_SHOW_ALL_BUGS_MODELS         . '">Show all Bugs (Models)</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_SHOW_ALL_BUGS_ARRAYS         . '">Show all Bugs (Arrays)</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_SHOW_ALL_BUGS_REPOSITORY     . '">Show all Bugs (Repository)</a>');
        Service_Console::log();
        Service_Console::log('<a href="?action=' . self::ACTION_SHOW_OPEN_BUGS_WITH_PRODUCTS . '">Show open Bugs with according Products</a>');
        Service_Console::log();
        Service_Console::log('<a href="?action=' . self::ACTION_ALTER_PRODUCT_NAME           . '">Alter a product\'s name</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_CLOSE_BUG                    . '">Set a Bug\'s status to \'CLOSE\'</a>');
        Service_Console::log();
        Service_Console::log('<a href="?action=' . self::ACTION_SHOW_USER_DASHBOARD          . '">Show a user\'s dashboard with all open bugs</a>');
        Service_Console::log();
    }

}