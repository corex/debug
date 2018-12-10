<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug;

use CoRex\Debug\Dump;
use PHPUnit\Framework\TestCase;

class DumpTest extends TestCase
{
    /**
     * Test isCli().
     */
    public function testIsCLI(): void
    {
        $this->assertTrue(Dump::isCLI());
    }
}