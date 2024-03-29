<?php

declare(strict_types=1);

namespace CoRex\Debug\Base;

use ReflectionClass;
use ReflectionException;

abstract class BaseObject extends BaseValue
{
    public const MESSAGE_OBJECT = 'Value is not an object.';
    public const MESSAGE_BOTH = 'Value is neither an object nor a class.';

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
        if (is_array($objectOrClass) || !class_exists((string)$objectOrClass)) {
            dump(self::MESSAGE_BOTH);
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