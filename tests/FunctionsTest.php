<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug;

use CoRex\Debug\Dump;
use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    /**
     * Test d_show_uses().
     *
     * Must be placed as first test since it needs the actual line number for testing.
     */
    public function testDShowUses(): void
    {
        Dump::showUses(false);
        $this->assertFalse(Dump::isUsesVisible());
        d_show_uses();

        // Set custom var dumper handler to catch output.
        VarDumperHandler::enable();

        // Dump random value.
        d('testing');

        // Reset var dumper handler.
        VarDumperHandler::disable();

        $output = 'd(value) in [' . __FILE__ . ':27]';
        $this->assertEquals($output, VarDumperHandler::value());

        $this->assertTrue(Dump::isUsesVisible());
        Dump::showUses(false);
    }

    /**
     * Test d().
     */
    public function testD(): void
    {
        Dump::showUses(false);

        // Check user defined function.
        $this->assertTrue(in_array('d', $this->getUserDefinedFunctions()));

        $randomValue = md5((string)mt_rand(1, 100000));

        // Set custom var dumper handler to catch output.
        VarDumperHandler::enable();

        // Dump random value.
        d($randomValue);

        // Reset var dumper handler.
        VarDumperHandler::disable();

        $this->assertEquals($randomValue, VarDumperHandler::value());
    }

    /**
     * Test dv().
     */
    public function testDV(): void
    {
        VarDumperHandler::enable();

        dv('testing')->value();

        VarDumperHandler::disable();

        $this->assertEquals('testing', VarDumperHandler::value());
    }

    /**
     * Test dse().
     */
    public function testDSE(): void
    {
        Dump::disableRemoteServerHandler();
        $this->assertFalse(Dump::isRemoteServerHandlerEnabled());
        dse();
        $this->assertTrue(Dump::isRemoteServerHandlerEnabled());
        Dump::disableRemoteServerHandler();
    }

    /**
     * Test dsd().
     */
    public function testDSD(): void
    {
        Dump::enableRemoteServerHandler();
        $this->assertTrue(Dump::isRemoteServerHandlerEnabled());
        dsd();
        $this->assertFalse(Dump::isRemoteServerHandlerEnabled());
        Dump::disableRemoteServerHandler();
    }

    /**
     * Test ds().
     */
    public function testDS(): void
    {
        Dump::disableRemoteServerHandler();
        $this->assertFalse(Dump::isRemoteServerHandlerEnabled());

        ds('test');

        $this->assertTrue(Dump::isRemoteServerHandlerEnabled());
        Dump::disableRemoteServerHandler();
    }

    /**
     * Test dsv().
     */
    public function testDSV(): void
    {
        Dump::disableRemoteServerHandler();
        $this->assertFalse(Dump::isRemoteServerHandlerEnabled());

        dsv('test')->value();

        $this->assertTrue(Dump::isRemoteServerHandlerEnabled());
        Dump::disableRemoteServerHandler();
    }

    /**
     * Get user defined functions.
     *
     * @return string[]
     */
    private function getUserDefinedFunctions(): array
    {
        $userDefinedFunctions = get_defined_functions();
        if (isset($userDefinedFunctions['user'])) {
            return $userDefinedFunctions['user'];
        }

        return [];
    }
}