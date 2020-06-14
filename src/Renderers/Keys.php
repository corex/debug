<?php

declare(strict_types=1);

namespace CoRex\Debug\Renderers;

use CoRex\Debug\Base\BaseValue;

class Keys extends BaseValue
{
    public const MESSAGE = 'Value is not array.';

    /**
     * Display keys.
     */
    public function display(): void
    {
        if (is_array($this->value)) {
            dump(array_keys($this->value));
        } else {
            dump(self::MESSAGE);
        }
    }
}