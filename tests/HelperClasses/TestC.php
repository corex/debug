<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\HelperClasses;

// @codingStandardsIgnoreFile
class TestC extends TestB implements TestCInterface
{
    public const CONST_C_PUBLIC = 'const.c.public';
    protected const CONST_C_PROTECTED = 'const.c.protected';
    private const CONST_C_PRIVATE = 'const.c.private';

    /**
     * Method test c_1.
     */
    public function methodTestC_1(): string
    {
        return self::CONST_C_PUBLIC;
    }

    /**
     * Method test c_2.
     */
    public function methodTestC_2(): string
    {
        return self::CONST_C_PRIVATE;
    }
}