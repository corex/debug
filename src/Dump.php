<?php

declare(strict_types=1);

namespace CoRex\Debug;

use CoRex\Debug\Base\ValueBase;
use CoRex\Debug\Renderers\Value;

class Dump
{
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
     * Value.
     *
     * @throws \Exception
     */
    public function value(): void
    {
        $this->execute(Value::class);
    }

    /**
     * Execute.
     *
     * @param string $class
     * @throws \Exception
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
            $uses = $this->renderer->getUses();
            if ($uses !== null) {
                dump($uses);
            }
        }
    }
}