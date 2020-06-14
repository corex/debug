<?php

declare(strict_types=1);

namespace CoRex\Debug\Base;

use CoRex\Debug\Dump;
use CoRex\Debug\Interfaces\ValueInterface;

abstract class BaseValue implements ValueInterface
{
    /** @var mixed|null */
    protected $value;

    /** @var string|null */
    private $function;

    /** @var string[] */
    private $uses;

    /** @var mixed[] */
    private $parameters;

    /**
     * Value base.
     *
     * @param mixed $value Default null.
     * @param string $function Default null.
     * @param string[] $uses
     * @param mixed[] $parameters
     */
    public function __construct($value = null, ?string $function = null, array $uses = [], array $parameters = [])
    {
        $this->value = $value;
        $this->function = $function;
        $this->uses = $uses;
        $this->parameters = $parameters;
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

    /**
     * Get parameter.
     *
     * @param string $name
     * @param mixed|null $default
     * @return mixed|null
     */
    public function getParameter(string $name, $default = null)
    {
        if (array_key_exists($name, $this->parameters)) {
            return $this->parameters[$name];
        }

        return $default;
    }

    /**
     * Get parameters.
     *
     * @return array|mixed[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}