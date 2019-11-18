<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug;

use CoRex\Debug\Dump;
use PHPUnit\Framework\TestCase;
use Symfony\Component\VarDumper\VarDumper;

class DumpTest extends TestCase
{
    /**
     * Test isCli().
     */
    public function testIsCLI(): void
    {
        $this->assertTrue(Dump::isCLI());
    }

    /**
     * Test initializeRemoteServerHandler().
     */
    public function testInitializeRemoteServerHandler(): void
    {
        $this->assertFalse(Dump::isRemoteServerHandlerInitialized());
        Dump::initializeRemoteServerHandler();
        $this->assertTrue(Dump::isRemoteServerHandlerInitialized());

        ds('testing');

        // Reset VarDumper handler to null.
        VarDumper::setHandler(null);
    }
}