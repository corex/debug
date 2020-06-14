<?php

declare(strict_types=1);

namespace CoRex\Debug\Renderers;

use CoRex\Debug\Base\BaseValue;

class Value extends BaseValue
{
    /**
     * Display.
     */
    public function display(): void
    {
        dump($this->value);
    }
}