<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\Renderers;

use CoRex\Debug\Renderers\Keys;
use PHPUnit\Framework\TestCase;
use Tests\CoRex\Debug\VarDumperHandler;

class KeysTest extends TestCase
{
    /**
     * Test display.
     */
    public function testDisplay(): void
    {
        VarDumperHandler::enable();

        $array = [
            'firstname' => 'Roger',
            'lastname' => 'Moore'
        ];

        (new Keys($array))->display();

        VarDumperHandler::disable();

        $this->assertSame(array_keys($array), VarDumperHandler::value());
    }

    /**
     * Test display not array.
     */
    public function testDisplayNotArray(): void
    {
        VarDumperHandler::enable();

        (new Keys('not.array'))->display();

        VarDumperHandler::disable();

        $this->assertSame(Keys::MESSAGE, VarDumperHandler::value());
    }
}