<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\Renderers;

use CoRex\Debug\Renderers\MD5;
use PHPUnit\Framework\TestCase;
use Tests\CoRex\Debug\VarDumperHandler;

class MD5Test extends TestCase
{
    /**
     * Test display.
     */
    public function testDisplay(): void
    {
        VarDumperHandler::enable();

        $randomString = md5((string)random_int(1, 100000));

        $value = new MD5($randomString, 'test');
        $value->display();

        VarDumperHandler::disable();
        $this->assertSame(md5($randomString), VarDumperHandler::value());
    }
}