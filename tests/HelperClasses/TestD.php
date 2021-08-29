<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\HelperClasses;

// @codingStandardsIgnoreFile
class TestD extends TestC implements TestDInterface
{
    public const CONST_D_PUBLIC = 'const.d.public';
    protected const CONST_D_PROTECTED = 'const.d.protected';
    private const CONST_D_PRIVATE = 'const.d.private';

    /**
     * Method test d_1.
     */
    public function methodTestD_1(): string
    {
        return self::CONST_D_PUBLIC;
    }

    /**
     * Method test d_2.
     */
    public function methodTestD_2(): string
    {
        return self::CONST_D_PRIVATE;
    }
}