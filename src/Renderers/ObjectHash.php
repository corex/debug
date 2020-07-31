<?php

declare(strict_types=1);

namespace CoRex\Debug\Renderers;

use CoRex\Debug\Base\BaseObject;

class ObjectHash extends BaseObject
{
    /**
     * Display.
     */
    public function display(): void
    {
        $object = $this->value;
        if (is_object($object)) {
            $class = get_class($object);
            $objectHash = spl_object_hash($object);
            dump($objectHash . ' -> ' . $class);
        } else {
            dump(BaseObject::MESSAGE_OBJECT);
        }
    }
}