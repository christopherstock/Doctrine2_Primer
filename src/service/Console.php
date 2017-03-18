<?php
/**
 * The console system that outputs colored messages to the web view.
 */
class Service_Console
{

    const COLOR_BLACK      = '#000000';
    const COLOR_GREEN      = '#00bb00';
    const COLOR_RED        = '#ff0000';
    const COLOR_GREY_LIGHT = '#e9e9e9';

    /**
     * Logs a message to the web view.
     *
     * @param string $message The message to log.
     * @param string $color   The color of the message to log.
     */
    public static function log($message = ' ', $color = self::COLOR_BLACK)
    {
        echo (
            '<pre style="color: '
            . $color
            . '; background-color: '
            . self::COLOR_GREY_LIGHT
            . '; margin: 0; padding: 0 10 0 10;">'
        );
        echo $message;
        echo '</pre>';
    }

}