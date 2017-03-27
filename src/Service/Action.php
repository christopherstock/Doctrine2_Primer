<?php
/**
 * Represents the action system.
 */
class Service_Action
{

    const ACTION_0_SHOW_MAIN_MENU                    = 0;
    const ACTION_1_CREATE_USER                       = 1;
    const ACTION_2_CREATE_PRODUCT                    = 2;
    const ACTION_3_FIND_PRODUCT_BY_ID                = 3;
    const ACTION_4_CREATE_BUG                        = 4;
    const ACTION_5_FIND_BUG_BY_ID                    = 5;
    const ACTION_6_UPDATE_PRODUCT_NAME               = 6;
    const ACTION_7_UPDATE_BUG_STATUS                 = 7;
    const ACTION_8_FIND_PRODUCT_BY_NAME              = 8;
    const ACTION_9_FIND_BUGS_BY_STATUS               = 9;
    const ACTION_10_FIND_ALL_PRODUCTS                = 10;
    const ACTION_11_SHOW_ALL_BUGS_MODELS             = 11;
    const ACTION_12_SHOW_ALL_BUGS_ARRAYS             = 12;
    const ACTION_13_SHOW_USER_DASHBOARD              = 13;
    const ACTION_14_SHOW_ALL_BUGS_REPOSITORY         = 14;
    const ACTION_15_SHOW_OPEN_BUG_COUNT_FOR_PRODUCTS = 15;

    /**
     * Performs the specified action.
     *
     * @param int $id The id of the action to perform.
     */
    public static function perform($id)
    {
        switch ($id) {

            case self::ACTION_0_SHOW_MAIN_MENU:
                self::showMainMenu();
                break;

            case self::ACTION_1_CREATE_USER:
                Example_User::create();
                break;

            case self::ACTION_2_CREATE_PRODUCT:
                Example_Product::create();
                break;

            case self::ACTION_3_FIND_PRODUCT_BY_ID:
                Example_Product::findById();
                break;

            case self::ACTION_4_CREATE_BUG:
                Example_Bug::create();
                break;

            case self::ACTION_5_FIND_BUG_BY_ID:
                Example_Bug::findById();
                break;

            case self::ACTION_6_UPDATE_PRODUCT_NAME:
                Example_Product::updateProductName();
                break;

            case self::ACTION_7_UPDATE_BUG_STATUS:
                Example_Bug::close();
                break;

            case self::ACTION_8_FIND_PRODUCT_BY_NAME:
                Example_Product::findByName();
                break;

            case self::ACTION_9_FIND_BUGS_BY_STATUS:
                Example_Bug::findByStatus();
                break;

            case self::ACTION_10_FIND_ALL_PRODUCTS:
                Example_Product::findAll();
                break;

            case self::ACTION_11_SHOW_ALL_BUGS_MODELS:
                Example_Bug::showAllUsingModels();
                break;

            case self::ACTION_12_SHOW_ALL_BUGS_ARRAYS:
                Example_Bug::showAllUsingArrays();
                break;

            case self::ACTION_13_SHOW_USER_DASHBOARD:
                Example_User::showDashboard();
                break;

            case self::ACTION_14_SHOW_ALL_BUGS_REPOSITORY:
                Example_Bug::showAllUsingRepository();
                break;

            case self::ACTION_15_SHOW_OPEN_BUG_COUNT_FOR_PRODUCTS:
                Example_Bug::showOpenBugCountForProducts();
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
        Service_Console::logSpacer();
    }

    /**
     * @return int
     */
    public static function getActionIdToPerform()
    {
        if (isset($_GET['action'])) {
            return $_GET['action'];
        } else {
            return Service_Action::ACTION_0_SHOW_MAIN_MENU;
        }
    }

    /**
     * @return void
     */
    private static function showMainMenu()
    {
        Service_Console::logSpacer();

        Service_Console::log();
        Service_Console::log('Welcome to the <b>main menu</b>. Please choose your action:');
        Service_Console::log();

        Service_Console::log('Simple model creation:');
        Service_Console::log('<a href="?action=' . self::ACTION_1_CREATE_USER                       . '">1. Create User</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_2_CREATE_PRODUCT                    . '">2. Create Product</a>');
        Service_Console::log();
        Service_Console::log('Simple model retrieval:');
        Service_Console::log('<a href="?action=' . self::ACTION_3_FIND_PRODUCT_BY_ID                . '">3. Find Product by id</a>');
        Service_Console::log();
        Service_Console::log('Dependent model creation:');
        Service_Console::log('<a href="?action=' . self::ACTION_4_CREATE_BUG                        . '">4. Create Bug</a>');
        Service_Console::log();
        Service_Console::log('Lazy loading:');
        Service_Console::log('<a href="?action=' . self::ACTION_5_FIND_BUG_BY_ID                    . '">5. Find Bug by id</a>');
        Service_Console::log();
        Service_Console::log('Simple model update:');
        Service_Console::log('<a href="?action=' . self::ACTION_6_UPDATE_PRODUCT_NAME               . '">6. Update a product\'s name</a>');
        Service_Console::log();
        Service_Console::log('Simple model update with own model method:');
        Service_Console::log('<a href="?action=' . self::ACTION_7_UPDATE_BUG_STATUS                 . '">7. Update a Bug\'s status to \'CLOSE\'</a>');
        Service_Console::log();
        Service_Console::log('Model retrieval via Repository:');
        Service_Console::log('<a href="?action=' . self::ACTION_8_FIND_PRODUCT_BY_NAME              . '">8. Find Product by name</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_9_FIND_BUGS_BY_STATUS               . '">9. Find Bugs by status</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_10_FIND_ALL_PRODUCTS                . '">10. Find all Products</a>');
        Service_Console::log();
        Service_Console::log('Using DQL:');
        Service_Console::log('<a href="?action=' . self::ACTION_11_SHOW_ALL_BUGS_MODELS             . '">11. Show all Bugs (Models)</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_12_SHOW_ALL_BUGS_ARRAYS             . '">12. Show all Bugs (Arrays)</a>');
        Service_Console::log('<a href="?action=' . self::ACTION_13_SHOW_USER_DASHBOARD              . '">13. Show a user\'s dashboard with all open bugs</a>');
        Service_Console::log();
        Service_Console::log('Using DQL and own repository class:');
        Service_Console::log('<a href="?action=' . self::ACTION_14_SHOW_ALL_BUGS_REPOSITORY         . '">14. Show all Bugs (own repository)</a>');
        Service_Console::log();
        Service_Console::log('Scalar value retrieval:');
        Service_Console::log('<a href="?action=' . self::ACTION_15_SHOW_OPEN_BUG_COUNT_FOR_PRODUCTS . '">15. Show open Bugs with according product count</a>');
        Service_Console::log();
    }

}