<?php
declare(strict_types=1);

namespace ExifReader\GeoLocation;

class Altitude
{
    /** @var float|null */
    private $floatValue;

    public function __construct(?float $floatValue)
    {
        $this->floatValue = $floatValue;
    }

    public static function fromString(string $string): self
    {
        if (! self::guardValidString($string)) {
            return self::undefined();
        }

        $stringParts = explode('/', $string);
        $floatValue = round(intval($stringParts[0]) / intval($stringParts[1]), 2);

        return new self($floatValue);
    }

    public static function undefined(): self
    {
        return new self(null);
    }

    private static function guardValidString(string $string): bool
    {
        if (strpos($string, '/') === false) {
            return false;
        }
        $stringParts = explode('/', $string);
        if (! is_numeric($stringParts[0]) || ! is_numeric($stringParts[1])) {
            return false;
        }

        return true;
    }

    public function getFloat(): ?float
    {
        return $this->floatValue;
    }
}
