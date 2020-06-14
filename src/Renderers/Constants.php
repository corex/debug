<?php

declare(strict_types=1);

namespace CoRex\Debug\Renderers;

use CoRex\Debug\Base\BaseObject;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionException;

class Constants extends BaseObject
{
    /**
     * Display.
     *
     * @throws ReflectionException
     */
    public function display(): void
    {
        $class = $this->getClass();
        if ($class === null) {
            return;
        }

        $reflectionClass = new ReflectionClass($class);
        $constantNames = array_keys($reflectionClass->getConstants());
        $result = [];
        foreach ($constantNames as $constantName) {
            $reflectionClassConstant = new ReflectionClassConstant($class, $constantName);
            if ($reflectionClassConstant->isPublic()) {
                $result[] = $constantName;
            }
        }

        dump($result);
    }
}