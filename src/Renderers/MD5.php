<?php

declare(strict_types=1);

namespace CoRex\Debug\Renderers;

use CoRex\Debug\Base\BaseValue;

class MD5 extends BaseValue
{
    /**
     * Display.
     */
    public function display(): void
    {
        dump(md5((string)$this->value));
    }
}