<?php

declare(strict_types=1);

namespace CoRex\Debug\Base;

use CoRex\Debug\Dump;

abstract class ValueBase implements ValueInterface
{
    /** @var mixed|null */
    protected $value;

    /** @var string|null */
    private $function;

    /** @var string[] */
    private $uses;

    /**
     * Value base.
     *
     * @param mixed $value Default null.
     * @param string $function Default null.
     * @param string[] $uses
     */
    public function __construct($value = null, ?string $function = null, array $uses = [])
    {
        $this->value = $value;
        $this->function = $function;
        $this->uses = $uses;
    }

    /**
     * Get uses.
     *
     * @return string|null
     */
    public function getUses(): ?string
    {
        if (!Dump::isUsesVisible()) {
            return null;
        }

        $entry = $this->uses;
        $function = $this->function . '(value)';
        $file = $entry['file'];
        $line = $entry['line'];
        if ($entry['function'] !== $this->function) {
            $function .= '->' . $entry['function'] . '()';
        }
        return $function . ' in [' . $file . ':' . $line . ']';
    }
}