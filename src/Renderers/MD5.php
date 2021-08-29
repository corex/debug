<?php

declare(strict_types=1);

namespace CoRex\Debug\Renderers;

use CoRex\Debug\Base\BaseValue;

class MD5 extends BaseValue
{
    public const MESSAGE = 'Not possible to create md5.';

    /**
     * Display.
     */
    public function display(): void
    {
        if (!is_array($this->value)) {
            dump(md5((string)$this->value));
        } else {
            dump(self::MESSAGE);
        }
    }
}