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
    const COLOR_WHITE      = '#ffffff';

    /**
     * Logs a message to the web view.
     *
     * @param string $message The message to log.
     * @param string $color   The color of the message to log.
     * @param string $bgColor The color of the background.
     */
    public static function log($message = ' ', $color = self::COLOR_BLACK, $bgColor = self::COLOR_GREY_LIGHT)
    {
        echo (
            '<pre style="color: '
            . $color
            . '; background-color: '
            . $bgColor
            . '; margin: 0; padding: 0 10 0 10;">'
        );
        echo $message;
        echo '</pre>';
    }

    /**
     * Logs a spacer with a white bg.
     */
    public static function logSpacer()
    {
        self::log(' ', Service_Console::COLOR_BLACK, Service_Console::COLOR_WHITE);
    }

}