<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\Renderers;

use CoRex\Debug\Renderers\Constants;
use PHPUnit\Framework\TestCase;
use Tests\CoRex\Debug\HelperClasses\TestD;
use Tests\CoRex\Debug\VarDumperHandler;

class ConstantsTest extends TestCase
{
    /**
     * Test display.
     */
    public function testDisplay(): void
    {
        VarDumperHandler::enable();

        (new Constants(new TestD()))->display();

        VarDumperHandler::disable();

        $check = [
            'CONST_D_PUBLIC',
            'CONST_C_PUBLIC',
            'CONST_B_PUBLIC',
            'CONST_A_PUBLIC'
        ];

        $this->assertSame($check, VarDumperHandler::value());
    }

    /**
     * Test display no object or class.
     */
    public function testDisplayNoObjectOrClass(): void
    {
        VarDumperHandler::enable();

        (new Constants('not.a.class', null, [], []))->display();

        VarDumperHandler::disable();

        $this->assertSame(Constants::MESSAGE_BOTH, VarDumperHandler::value());
    }
}