<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\HelperClasses;

// @codingStandardsIgnoreFile
class TestB extends TestA implements TestBInterface
{
    public const CONST_B_PUBLIC = 'const.b.public';
    protected const CONST_B_PROTECTED = 'const.b.protected';
    private const CONST_B_PRIVATE = 'const.b.private';

    /**
     * Method test b_1.
     */
    public function methodTestB_1(): string
    {
        return self::CONST_B_PUBLIC;
    }

    /**
     * Method test b_2.
     */
    public function methodTestB_2(): string
    {
        return self::CONST_B_PRIVATE;
    }
}