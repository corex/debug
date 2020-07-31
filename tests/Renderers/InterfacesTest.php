<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\Renderers;

use CoRex\Debug\Renderers\Interfaces;
use PHPUnit\Framework\TestCase;
use Tests\CoRex\Debug\HelperClasses\TestD;
use Tests\CoRex\Debug\VarDumperHandler;

class InterfacesTest extends TestCase
{
    /**
     * Test display.
     */
    public function testDisplay(): void
    {
        VarDumperHandler::enable();

        (new Interfaces(new TestD()))->display();

        VarDumperHandler::disable();

        $check = [
            'Tests\CoRex\Debug\HelperClasses\TestAInterface',
            'Tests\CoRex\Debug\HelperClasses\TestBInterface',
            'Tests\CoRex\Debug\HelperClasses\TestCInterface',
            'Tests\CoRex\Debug\HelperClasses\TestDInterface'
        ];

        $this->assertSame($check, VarDumperHandler::value());
    }

    /**
     * Test display no object or class.
     */
    public function testDisplayNoObjectOrClass(): void
    {
        VarDumperHandler::enable();

        (new Interfaces('not.a.class', null, [], []))->display();

        VarDumperHandler::disable();

        $this->assertSame(Interfaces::MESSAGE_BOTH, VarDumperHandler::value());
    }
}