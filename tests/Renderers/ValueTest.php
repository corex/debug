<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\Renderers;

use CoRex\Debug\Renderers\Value;
use PHPUnit\Framework\TestCase;
use Tests\CoRex\Debug\VarDumperHandler;

class ValueTest extends TestCase
{
    /**
     * Test display.
     */
    public function testDisplay(): void
    {
        VarDumperHandler::enable();

        $value = new Value('test', 'test');
        $value->display();

        VarDumperHandler::disable();
        $this->assertEquals('test', VarDumperHandler::value());
    }
}