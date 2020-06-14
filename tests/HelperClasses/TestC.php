<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\HelperClasses;

class TestC extends TestB implements TestCInterface
{
    public const CONST_C_PUBLIC = 'const.c.public';
    protected const CONST_C_PROTECTED = 'const.c.protected';
    private const CONST_C_PRIVATE = 'const.c.private';

    public function methodTestC_1() {}
    public function methodTestC_2() {}
}