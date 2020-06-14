<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\HelperClasses;

class TestD extends TestC implements TestDInterface
{
    public const CONST_D_PUBLIC = 'const.d.public';
    protected const CONST_D_PROTECTED = 'const.d.protected';
    private const CONST_D_PRIVATE = 'const.d.private';

    public function methodTestD_1() {}
    public function methodTestD_2() {}
}