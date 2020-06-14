<?php

declare(strict_types=1);

namespace CoRex\Debug\Base;

use ReflectionClass;
use ReflectionException;

abstract class BaseObject extends BaseValue
{
    public const MESSAGE = 'Value is neither an object nor a class.';

    /**
     * Get class.
     *
     * @return string|null
     */
    protected function getClass(): ?string
    {
        $objectOrClass = $this->value;

        // Get class if object.
        if (is_object($objectOrClass)) {
            $objectOrClass = get_class($objectOrClass);
        }

        // Show message if class does not exists.
        if (!class_exists($objectOrClass)) {
            dump(self::MESSAGE);
            $objectOrClass = null;
        }

        return $objectOrClass;
    }

    /**
     * Get reflection class.
     *
     * @return ReflectionClass|null
     * @throws ReflectionException
     */
    protected function getReflectionClass(): ?ReflectionClass
    {
        $class = $this->getClass();

        if ($class === null) {
            return null;
        }

        return new ReflectionClass($class);
    }
}