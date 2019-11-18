<?php

declare(strict_types=1);

use CoRex\Debug\Dump;

if (!function_exists('d')) {
    /**
     * Dump.
     */
    function d(): void
    {
        $backtrace = debug_backtrace();
        (new Dump(func_get_args(), __FUNCTION__, $backtrace))->value();
    }
}
if (!function_exists('ds')) {
    /**
     * Dump.
     */
    function ds(): void
    {
        Dump::initializeRemoteServerHandler();
        $backtrace = debug_backtrace();
        (new Dump(func_get_args(), __FUNCTION__, $backtrace))->value();
    }
}
if (!function_exists('d_show_uses')) {
    /**
     * Show debug uses.
     */
    function d_show_uses(): void
    {
        Dump::showUses();
    }
}
