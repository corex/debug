<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\HelperClasses;

// @codingStandardsIgnoreFile
class TestA implements TestAInterface
{
    public const CONST_A_PUBLIC = 'const.a.public';
    protected const CONST_A_PROTECTED = 'const.a.protected';
    private const CONST_A_PRIVATE = 'const.a.private';

    /**
     * Method test a_1.
     */
    public function methodTestA_1(): string
    {
        return self::CONST_A_PUBLIC;
    }

    /**
     * Method test a_2.
     */
    public function methodTestA_2(): string
    {
        return self::CONST_A_PRIVATE;
    }
}