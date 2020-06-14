<?php

declare(strict_types=1);

namespace CoRex\Debug\Renderers;

use CoRex\Debug\Base\BaseObject;

class Extend extends BaseObject
{
    /**
     * Display.
     */
    public function display(): void
    {
        $class = $this->getClass();
        if ($class === null) {
            return;
        }

        dump(array_values(class_parents($class)));
    }
}