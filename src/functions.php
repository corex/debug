<?php

declare(strict_types=1);

use CoRex\Debug\Dump;

if (!function_exists('d')) {
    /**
     * Dump value(s).
     *
     * @return Dump
     */
    function d(): Dump
    {
        $backtrace = debug_backtrace();

        return (new Dump(func_get_args(), __FUNCTION__, $backtrace))->value();
    }
}

if (!function_exists('dv')) {
    /**
     * Dump value(s) and return expressive caster.
     */
    function dv(): Dump
    {
        $backtrace = debug_backtrace();

        return new Dump(func_get_args(), __FUNCTION__, $backtrace);
    }
}

if (!function_exists('dse')) {
    /**
     * Enable remote server dumper handler.
     *
     * All dump functions will from this point only dump to remote server,
     * even if remote server has not been started.
     */
    function dse(): void
    {
        Dump::enableRemoteServerHandler();
    }
}

if (!function_exists('dsd')) {
    /**
     * Disable remote server dumper handler.
     *
     * All dump functions will from this point only dump to remote server,
     * even if remote server has not been started.
     */
    function dsd(): void
    {
        Dump::disableRemoteServerHandler();
    }
}

if (!function_exists('ds')) {
    /**
     * Dump value(s) to server only.
     *
     * All dump functions will from this point only dump to remote server,
     * even if remote server has not been started.
     */
    function ds(): void
    {
        Dump::enableRemoteServerHandler();
        $backtrace = debug_backtrace();
        (new Dump(func_get_args(), __FUNCTION__, $backtrace))->value();
    }
}

if (!function_exists('dsv')) {
    /**
     * Dump value(s) to server only and return expressive caster.
     *
     * All dump functions will from this point only dump to remote server,
     * even if remote server has not been started.
     */
    function dsv(): Dump
    {
        Dump::enableRemoteServerHandler();
        $backtrace = debug_backtrace();

        return new Dump(func_get_args(), __FUNCTION__, $backtrace);
    }
}

if (!function_exists('d_show_uses')) {
    /**
     * Show debug uses.
     *
     * Note: only works when methods has been called. Must be called last in the chain of debug functions.
     */
    function d_show_uses(): void
    {
        Dump::showUses();
    }
}
