<?php

declare(strict_types=1);

namespace CoRex\Debug\Renderers;

use CoRex\Debug\Base\BaseValue;

class Json extends BaseValue
{
    public const MESSAGE = 'Value is not array.';
    public const JSON_OPTIONS = JSON_UNESCAPED_SLASHES + JSON_PRETTY_PRINT;

    /**
     * Display.
     */
    public function display(): void
    {
        if (is_array($this->value)) {
            dump(json_encode($this->value, self::JSON_OPTIONS));
        } else {
            dump(self::MESSAGE);
        }
    }
}