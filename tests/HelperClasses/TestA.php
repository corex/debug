<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\HelperClasses;

class TestA implements TestAInterface
{
    public const CONST_A_PUBLIC = 'const.a.public';
    protected const CONST_A_PROTECTED = 'const.a.protected';
    private const CONST_A_PRIVATE = 'const.a.private';

    public function methodTestA_1() {}
    public function methodTestA_2() {}
}