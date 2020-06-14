<?php

declare(strict_types=1);

namespace CoRex\Debug\Renderers;

use CoRex\Debug\Base\BaseObject;
use ReflectionException;

class Methods extends BaseObject
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

        $flattened = $this->getParameter('flattened');

        $result = [];
        $addedClasses = [];
        $methods = $reflectionClass->getMethods();
        foreach ($methods as $method) {
            $declaringClass = $method->getDeclaringClass()->getName();
            if (!in_array($declaringClass, $addedClasses)) {
                if (!$flattened && count($result) > 0) {
                    $result[] = '';
                }

                $addedClasses[] = $declaringClass;
                if (!$flattened) {
                    $result[] = $declaringClass;
                }
            }

            $methodName = $method->getName();
            if (!$flattened) {
                $methodName = '- ' . $methodName;
            }

            $result[] = $methodName;
        }

        // Sort if flattened.
        if ($flattened) {
            sort($result);
        }

        dump($result);
    }
}