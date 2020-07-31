<?php

declare(strict_types=1);

namespace CoRex\Debug;

use CoRex\Debug\Base\BaseValue;
use CoRex\Debug\Renderers\Constants as ConstantsRenderer;
use CoRex\Debug\Renderers\Extend;
use CoRex\Debug\Renderers\Interfaces;
use CoRex\Debug\Renderers\Json;
use CoRex\Debug\Renderers\Keys;
use CoRex\Debug\Renderers\MD5;
use CoRex\Debug\Renderers\Methods;
use CoRex\Debug\Renderers\ObjectHash;
use CoRex\Debug\Renderers\Value;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\ServerDumper;
use Symfony\Component\VarDumper\VarDumper;

class Dump
{
    /** @var bool */
    private static $dumpServerEnabled = false;

    /** @var BaseValue */
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
    public static function enableRemoteServerHandler(): void
    {
        VarDumper::setHandler(function ($var): void {
            $cloner = new VarCloner();
            $dumper = new ServerDumper('tcp://' . Constants::HOST_PORT);
            $dumper->dump($cloner->cloneVar($var));
        });

        self::$dumpServerEnabled = true;
    }

    /**
     * Reset remote server handler.
     */
    public static function disableRemoteServerHandler(): void
    {
        VarDumper::setHandler(null);

        self::$dumpServerEnabled = false;
    }

    /**
     * Is remote server handler enabled.
     *
     * @return bool
     */
    public static function isRemoteServerHandlerEnabled(): bool
    {
        return self::$dumpServerEnabled;
    }

    /**
     * Value.
     *
     * @return $this
     */
    public function value(): self
    {
        $this->execute(Value::class);

        return $this;
    }

    /**
     * Keys.
     *
     * @return $this
     */
    public function keys(): self
    {
        $this->execute(Keys::class);

        return $this;
    }

    /**
     * Json.
     *
     * @return $this
     */
    public function json(): self
    {
        $this->execute(Json::class);

        return $this;
    }

    /**
     * Constants.
     *
     * @return $this
     */
    public function constants(): self
    {
        $this->execute(ConstantsRenderer::class);

        return $this;
    }

    /**
     * Methods.
     *
     * @param bool $flattened
     * @return $this
     */
    public function methods(bool $flattened = true): self
    {
        $this->execute(Methods::class, [
            'flattened' => $flattened
        ]);

        return $this;
    }

    /**
     * Interfaces.
     *
     * @return $this
     */
    public function interfaces(): self
    {
        $this->execute(Interfaces::class);

        return $this;
    }

    /**
     * Extend(s).
     *
     * @return $this
     */
    public function extend(): self
    {
        $this->execute(Extend::class);

        return $this;
    }

    /**
     * MD5.
     *
     * @return $this
     */
    public function md5(): self
    {
        $this->execute(MD5::class);

        return $this;
    }

    /**
     * Object hash.
     *
     * @return $this
     */
    public function objectHash(): self
    {
        $this->execute(ObjectHash::class);

        return $this;
    }

    /**
     * Execute.
     *
     * @param string $class
     * @param mixed[] $classParameters
     */
    private function execute(string $class, array $classParameters = []): void
    {
        // Get uses.
        $uses = $this->uses;
        if (count($uses) >= 2) {
            reset($uses);
            $uses = current($uses);
        }

        // Execute renderer.
        foreach ($this->values as $value) {
            $this->renderer = new $class($value, $this->function, $uses, $classParameters);
            $this->renderer->display();
            $renderedUses = $this->renderer->getUses();
            if ($renderedUses !== null) {
                dump($renderedUses);
            }
        }
    }
}