<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\Base;

use CoRex\Debug\Dump;
use PHPUnit\Framework\TestCase;
use Tests\CoRex\Debug\HelperClasses\HelperBaseValue;

class BaseValueTest extends TestCase
{
    /**
     * Test.
     */
    public function testConstructor(): void
    {
        $uses = [
            'file' => 'file',
            'line' => 'line',
            'function' => 'function.2'
        ];
        $valueHelperBase = new HelperBaseValue('test', 'function.1', $uses);
        d_show_uses();
        $checkUses = $valueHelperBase->getUses();
        $this->assertEquals('function.1(value)->function.2() in [file:line]', $checkUses);
        Dump::showUses(false);
    }

    /**
     * Test getUses().
     */
    public function testGetUses(): void
    {
        $uses = [
            'file' => 'file',
            'line' => 'line',
            'function' => 'function.2'
        ];
        $valueHelperBase = new HelperBaseValue('test', 'function.1', $uses);
        $checkUses = $valueHelperBase->getUses();
        $this->assertNull($checkUses);
    }

    /**
     * Test get parameters with constructor.
     */
    public function testGetParametersWithConstructor(): void
    {
        $uses = [
            'file' => 'file',
            'line' => 'line',
            'function' => 'function.2'
        ];
        $valueHelperBase = new HelperBaseValue('test', 'function.1', $uses, $uses);

        $this->assertSame($uses, $valueHelperBase->getParameters());
    }

    /**
     * Test get parameter.
     */
    public function testGetParameter(): void
    {
        $uses = [
            'file' => 'file',
            'line' => 'line',
            'function' => 'function.2'
        ];
        $valueHelperBase = new HelperBaseValue('test', 'function.1', $uses, $uses);

        $this->assertSame($uses['file'], $valueHelperBase->getParameter('file'));
        $this->assertSame($uses['line'], $valueHelperBase->getParameter('line'));
        $this->assertSame($uses['function'], $valueHelperBase->getParameter('function'));
        $this->assertSame('unknown.default', $valueHelperBase->getParameter('unknown', 'unknown.default'));
    }
}