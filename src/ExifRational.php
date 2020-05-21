<?php
declare(strict_types=1);

namespace ExifReader;

trait ExifRational
{
    /** @var float|null */
    private $floatValue;

    private function __construct(?float $floatValue)
    {
        $this->floatValue = $floatValue;
    }

    public static function fromExifRational(string $string): self
    {
        if (strpos($string, '/') === false) {
            return self::undefined();
        }
        $stringParts = explode('/', $string);
        $floatVal = intval($stringParts[0]) / intval($stringParts[1]);

        return new self($floatVal);
    }

    public function getFloatValue(): ?float
    {
        return $this->floatValue;
    }

    public static function undefined(): self
    {
        return new self(null);
    }

    public function __toString(): string
    {
        return (string)$this->floatValue;
    }
}
