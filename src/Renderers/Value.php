<?php

declare(strict_types=1);

namespace CoRex\Debug\Renderers;

use CoRex\Debug\Base\ValueBase;

class Value extends ValueBase
{
    /**
     * Display.
     */
    public function display(): void
    {
        dump($this->value);
    }
}