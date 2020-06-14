<?php

declare(strict_types=1);

namespace CoRex\Debug\Interfaces;

interface ValueInterface
{
    /**
     * Display.
     */
    public function display(): void;
}