<?php

declare(strict_types=1);

namespace CoRex\Debug;

use CoRex\Debug\Base\ValueBase;
use CoRex\Debug\Renderers\Value;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\ServerDumper;
use Symfony\Component\VarDumper\VarDumper;

class Dump
{
    public const DUMP_SERVER_INITIALIZE = 'DUMP-SERVER-INITIALIZE';

    /** @var ValueBase */
    private $renderer;

    /** @var mixed */
    private $values;

    /** @var string */
    private $function;

    /** @var string[] */
    private $uses;

    /** @var bool */
    private static $usesVisible = false;

    /**
     * Parse.
     *
     * @param mixed[] $values
     * @param string $function
     * @param string[] $uses
     */
    public function __construct(array $values, string $function, array $uses)
    {
        $this->values = $values;
        $this->function = $function;
        $this->uses = $uses;
    }

    /**
     * Show uses.
     *
     * @param bool $usesVisible
     */
    public static function showUses(bool $usesVisible = true): void
    {
        self::$usesVisible = $usesVisible;
    }

    /**
     * Do show uses.
     *
     * @return bool
     */
    public static function isUsesVisible(): bool
    {
        return self::$usesVisible;
    }

    /**
     * Is cli.
     *
     * @return bool
     */
    public static function isCLI(): bool
    {
        return PHP_SAPI === 'cli';
    }

    /**
     * Setup remote server handler.
     */
    public static function initializeRemoteServerHandler(): void
    {
        if (!self::isRemoteServerHandlerInitialized()) {
            VarDumper::setHandler(function ($var) {
                $cloner = new VarCloner();
                $dumper = new ServerDumper('tcp://' . Constants::HOST_PORT);
                $dumper->dump($cloner->cloneVar($var));
            });
            define(self::DUMP_SERVER_INITIALIZE, true);
        }
    }

    /**
     * Is remote server handler initialized.
     *
     * @return bool
     */
    public static function isRemoteServerHandlerInitialized(): bool
    {
        return defined(self::DUMP_SERVER_INITIALIZE);
    }

    /**
     * Value.
     */
    public function value(): void
    {
        $this->execute(Value::class);
    }

    /**
     * Execute.
     *
     * @param string $class
     */
    private function execute(string $class): void
    {
        // Get uses.
        $uses = $this->uses;
        if (count($uses) >= 2) {
            reset($uses);
            $uses = current($uses);
        }

        // Execute renderer.
        foreach ($this->values as $value) {
            $this->renderer = new $class($value, $this->function, $uses);
            $this->renderer->display();
            $renderedUses = $this->renderer->getUses();
            if ($renderedUses !== null) {
                dump($renderedUses);
            }
        }
    }
}