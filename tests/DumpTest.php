<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug;

use CoRex\Debug\Dump;
use CoRex\Debug\Renderers\Json;
use PHPUnit\Framework\TestCase;
use Symfony\Component\VarDumper\VarDumper;
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
     * Test enableRemoteServerHandler().
     */
    public function testEnableRemoteServerHandler(): void
    {
        Dump::disableRemoteServerHandler();
        $this->assertFalse(Dump::isRemoteServerHandlerEnabled());

        Dump::enableRemoteServerHandler();
        $this->assertTrue(Dump::isRemoteServerHandlerEnabled());

        ds('testing');

        // Reset VarDumper handler to null.
        VarDumper::setHandler(null);
    }

    /**
     * Test isableRemoteServerHandler().
     */
    public function testDisableRemoteServerHandler(): void
    {
        Dump::enableRemoteServerHandler();
        $this->assertTrue(Dump::isRemoteServerHandlerEnabled());

        Dump::disableRemoteServerHandler();
        $this->assertFalse(Dump::isRemoteServerHandlerEnabled());
    }

    /**
     * Test value.
     */
    public function testValue(): void
    {
        $randomString = md5((string)mt_rand(1, 100000));

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

        $this->assertEquals(array_keys($array), VarDumperHandler::value());
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

        $this->assertEquals(json_encode($array, Json::JSON_OPTIONS), VarDumperHandler::value());
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

        $this->assertEquals($check, VarDumperHandler::value());
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

        $this->assertEquals($check, VarDumperHandler::value());
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

        $this->assertEquals($check, VarDumperHandler::value());
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

        $this->assertEquals($check, VarDumperHandler::value());
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

        $this->assertEquals($check, VarDumperHandler::value());
    }
}