<?php

declare(strict_types=1);

if (!function_exists('d')) {
    /**
     * Dump.
     *
     * @throws Exception
     */
    function d(): void
    {
        $backtrace = debug_backtrace();
        (new \CoRex\Debug\Dump(func_get_args(), __FUNCTION__, $backtrace))->value();
    }
}
if (!function_exists('d_show_uses')) {
    /**
     * Show debug uses.
     *
     * @throws Exception
     */
    function d_show_uses(): void
    {
        \CoRex\Debug\Dump::showUses();
    }
}
