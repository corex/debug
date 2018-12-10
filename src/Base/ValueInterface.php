<?php

declare(strict_types=1);

namespace CoRex\Debug\Base;

interface ValueInterface
{
    /**
     * Display.
     */
    public function display(): void;
}