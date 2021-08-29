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
        $this->assertSame($output, VarDumperHandler::value());

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
        $this->assertTrue(in_array('d', $this->getUserDefinedFunctions(), true));

        $randomValue = md5((string)random_int(1, 100000));

        // Set custom var dumper handler to catch output.
        VarDumperHandler::enable();

        // Dump random value.
        d($randomValue);

        // Reset var dumper handler.
        VarDumperHandler::disable();

        $this->assertSame($randomValue, VarDumperHandler::value());
    }

    /**
     * Test dv().
     */
    public function testDV(): void
    {
        VarDumperHandler::enable();

        dv('testing')->value();

        VarDumperHandler::disable();

        $this->assertSame('testing', VarDumperHandler::value());
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