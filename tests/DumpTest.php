<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug;

use CoRex\Debug\Dump;
use CoRex\Debug\Renderers\Json;
use PHPUnit\Framework\TestCase;
use Tests\CoRex\Debug\HelperClasses\TestA;
use Tests\CoRex\Debug\HelperClasses\TestD;

class DumpTest extends TestCase
{
    /**
     * Test isCli().
     */
    public function testIsCLI(): void
    {
        $this->assertTrue(Dump::isCLI());
    }

    /**
     * Test value.
     */
    public function testValue(): void
    {
        $randomString = md5((string)random_int(1, 100000));

        VarDumperHandler::enable();

        (new Dump([$randomString], 'test', []))->value();

        VarDumperHandler::disable();

        $this->assertSame($randomString, VarDumperHandler::value());
    }

    /**
     * Test keys.
     */
    public function testKeys(): void
    {
        VarDumperHandler::enable();

        $array = [
            'firstname' => 'Roger',
            'lastname' => 'Moore'
        ];

        (new Dump([$array], 'test', []))->keys();

        VarDumperHandler::disable();

        $this->assertSame(array_keys($array), VarDumperHandler::value());
    }

    /**
     * Test json.
     */
    public function testJson(): void
    {
        VarDumperHandler::enable();

        $array = [
            'firstname' => 'Roger',
            'lastname' => 'Moore'
        ];

        (new Dump([$array], 'test', []))->json();

        VarDumperHandler::disable();

        $this->assertSame(json_encode($array, Json::JSON_OPTIONS), VarDumperHandler::value());
    }

    /**
     * Test constants.
     */
    public function testConstants(): void
    {
        VarDumperHandler::enable();

        (new Dump([new TestD()], 'test', []))->constants();

        VarDumperHandler::disable();

        $check = [
            'CONST_D_PUBLIC',
            'CONST_C_PUBLIC',
            'CONST_B_PUBLIC',
            'CONST_A_PUBLIC'
        ];

        $this->assertSame($check, VarDumperHandler::value());
    }

    /**
     * Test methods flattened.
     */
    public function testMethodsFlattened(): void
    {
        VarDumperHandler::enable();

        (new Dump([new TestD()], 'test', []))->methods(true);

        VarDumperHandler::disable();

        $check = [
            'methodTestA_1',
            'methodTestA_2',
            'methodTestB_1',
            'methodTestB_2',
            'methodTestC_1',
            'methodTestC_2',
            'methodTestD_1',
            'methodTestD_2'
        ];

        $this->assertSame($check, VarDumperHandler::value());
    }

    /**
     * Test methods detailed.
     */
    public function testMethodsDetailed(): void
    {
        VarDumperHandler::enable();

        (new Dump([new TestD()], 'test', []))->methods(false);

        VarDumperHandler::disable();

        $check = [
            'Tests\CoRex\Debug\HelperClasses\TestD',
            '- methodTestD_1',
            '- methodTestD_2',
            '',
            'Tests\CoRex\Debug\HelperClasses\TestC',
            '- methodTestC_1',
            '- methodTestC_2',
            '',
            'Tests\CoRex\Debug\HelperClasses\TestB',
            '- methodTestB_1',
            '- methodTestB_2',
            '',
            'Tests\CoRex\Debug\HelperClasses\TestA',
            '- methodTestA_1',
            '- methodTestA_2',
        ];

        $this->assertSame($check, VarDumperHandler::value());
    }

    /**
     * Test interfaces.
     */
    public function testInterfaces(): void
    {
        VarDumperHandler::enable();

        (new Dump([new TestD()], 'test', []))->interfaces();

        VarDumperHandler::disable();

        $check = [
            'Tests\CoRex\Debug\HelperClasses\TestAInterface',
            'Tests\CoRex\Debug\HelperClasses\TestBInterface',
            'Tests\CoRex\Debug\HelperClasses\TestCInterface',
            'Tests\CoRex\Debug\HelperClasses\TestDInterface'
        ];

        $this->assertSame($check, VarDumperHandler::value());
    }

    /**
     * Test extend.
     */
    public function testExtend(): void
    {
        VarDumperHandler::enable();

        (new Dump([new TestD()], 'test', []))->extend();

        VarDumperHandler::disable();

        $check = [
            'Tests\CoRex\Debug\HelperClasses\TestC',
            'Tests\CoRex\Debug\HelperClasses\TestB',
            'Tests\CoRex\Debug\HelperClasses\TestA'
        ];

        $this->assertSame($check, VarDumperHandler::value());
    }

    /**
     * Test md5.
     */
    public function testMD5(): void
    {
        VarDumperHandler::enable();

        $randomString = md5((string)random_int(1, 100000));

        (new Dump([$randomString], 'test', []))->md5();

        VarDumperHandler::disable();
        $this->assertSame(md5($randomString), VarDumperHandler::value());
    }

    /**
     * Test object hash.
     */
    public function testObjectHash(): void
    {
        VarDumperHandler::enable();

        $testA = new TestA();

        (new Dump([$testA], 'test', []))->objectHash();

        VarDumperHandler::disable();
        $this->assertSame(
            spl_object_hash($testA) . ' -> ' . TestA::class,
            VarDumperHandler::value()
        );
    }
}