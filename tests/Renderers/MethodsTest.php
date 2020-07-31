<?php

declare(strict_types=1);

namespace Tests\CoRex\Debug\Renderers;

use CoRex\Debug\Renderers\Methods;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Tests\CoRex\Debug\HelperClasses\TestD;
use Tests\CoRex\Debug\VarDumperHandler;

class MethodsTest extends TestCase
{
    /**
     * Test display flattened.
     */
    public function testDisplayFlattened(): void
    {
        VarDumperHandler::enable();

        (new Methods(new TestD(), null, [], [
            'flattened' => true
        ]))->display();

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
     * Test display detailed.
     */
    public function testDisplayDetailed(): void
    {
        VarDumperHandler::enable();

        (new Methods(new TestD(), null, [], [
            'flattened' => false
        ]))->display();

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
     * Test display no object or class.
     *
     * @throws ReflectionException
     */
    public function testDisplayNoObjectOrClass(): void
    {
        VarDumperHandler::enable();

        (new Methods('not.a.class', null, [], [
            'flattened' => true
        ]))->display();

        VarDumperHandler::disable();

        $this->assertSame(Methods::MESSAGE_BOTH, VarDumperHandler::value());
    }
}