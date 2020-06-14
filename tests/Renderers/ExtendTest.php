<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\Renderers;

use CoRex\Debug\Renderers\Extend;
use PHPUnit\Framework\TestCase;
use Tests\CoRex\Debug\HelperClasses\TestD;
use Tests\CoRex\Debug\VarDumperHandler;

class ExtendTest extends TestCase
{
    /**
     * Test display.
     */
    public function testDisplay(): void
    {
        VarDumperHandler::enable();

        (new Extend(new TestD()))->display();

        VarDumperHandler::disable();

        $check = [
            'Tests\CoRex\Debug\HelperClasses\TestC',
            'Tests\CoRex\Debug\HelperClasses\TestB',
            'Tests\CoRex\Debug\HelperClasses\TestA'
        ];

        $this->assertEquals($check, VarDumperHandler::value());
    }

    /**
     * Test display no object or class.
     */
    public function testDisplayNoObjectOrClass(): void
    {
        VarDumperHandler::enable();

        (new Extend('not.a.class', null, [], []))->display();

        VarDumperHandler::disable();

        $this->assertEquals(Extend::MESSAGE, VarDumperHandler::value());
    }
}