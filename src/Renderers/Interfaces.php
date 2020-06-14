<?php

declare(strict_types=1);

namespace CoRex\Debug\Renderers;

use CoRex\Debug\Base\BaseObject;
use ReflectionException;

class Interfaces extends BaseObject
{
    /**
     * Display.
     *
     * @throws ReflectionException
     */
    public function display(): void
    {
        $reflectionClass = $this->getReflectionClass();
        if ($reflectionClass === null) {
            return;
        }

        $result = $reflectionClass->getInterfaceNames();

        sort($result);
        dump($result);
    }
}