<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\Renderers;

use CoRex\Debug\Renderers\Json;
use CoRex\Debug\Renderers\Keys;
use PHPUnit\Framework\TestCase;
use Tests\CoRex\Debug\VarDumperHandler;

class JsonTest extends TestCase
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

        (new Json($array))->display();

        VarDumperHandler::disable();

        $this->assertSame(json_encode($array, Json::JSON_OPTIONS), VarDumperHandler::value());
    }

    /**
     * Test display not array.
     */
    public function testDisplayNotArray(): void
    {
        VarDumperHandler::enable();

        (new Json('not.array'))->display();

        VarDumperHandler::disable();

        $this->assertSame(Keys::MESSAGE, VarDumperHandler::value());
    }
}