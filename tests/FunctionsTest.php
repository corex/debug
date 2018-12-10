<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug;

use CoRex\Debug\Dump;
use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    /**
     * Test d().
     *
     * @throws \Exception
     */
    public function testD(): void
    {
        // Check user defined function.
        $this->assertTrue(in_array('d', $this->getUserDefinedFunctions()));

        $checkValue = null;
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
     * Test d_show_uses().
     *
     * @throws \Exception
     */
    public function testDShowUses(): void
    {
        Dump::showUses(false);
        $this->assertFalse(Dump::isUsesVisible());
        d_show_uses();
        $this->assertTrue(Dump::isUsesVisible());
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