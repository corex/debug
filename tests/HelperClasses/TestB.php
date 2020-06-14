<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\HelperClasses;

class TestB extends TestA implements TestBInterface
{
    public const CONST_B_PUBLIC = 'const.b.public';
    protected const CONST_B_PROTECTED = 'const.b.protected';
    private const CONST_B_PRIVATE = 'const.b.private';

    public function methodTestB_1() {}
    public function methodTestB_2() {}
}