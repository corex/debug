<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\Renderers;

use CoRex\Debug\Renderers\ObjectHash;
use PHPUnit\Framework\TestCase;
use Tests\CoRex\Debug\HelperClasses\TestA;
use Tests\CoRex\Debug\VarDumperHandler;

class ObjectHashTest extends TestCase
{
    /**
     * Test display.
     */
    public function testDisplay(): void
    {
        VarDumperHandler::enable();

        $testA = new TestA();

        (new ObjectHash($testA))->display();

        VarDumperHandler::disable();
        $this->assertSame(
            spl_object_hash($testA) . ' -> ' . TestA::class,
            VarDumperHandler::value()
        );
    }

    /**
     * Test display no object.
     */
    public function testDisplayNoObject(): void
    {
        VarDumperHandler::enable();

        (new ObjectHash('not.a.class'))->display();

        VarDumperHandler::disable();

        $this->assertSame(ObjectHash::MESSAGE_OBJECT, VarDumperHandler::value());
    }
}