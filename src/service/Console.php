<?php
/**
 * Handles Doctrine 2 framework bootstrapping.
 */
class Service_Console
{

    const COLOR_BLACK = '#000';
    const COLOR_GREEN = '#00ff00';

    /**
     * Logs a message to the web view.
     *
     * @param string $message The message to log.
     * @param string $color   The color of the message to log.
     */
    public static function log($message = ' ', $color = self::COLOR_BLACK)
    {
        echo '<pre style="color: ' . $color . '; background-color: #e0e0e0; margin: 0; padding: 0 10 0 10;">';
        echo $message;
        echo '</pre>';
    }

}