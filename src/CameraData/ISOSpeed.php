<?php
declare(strict_types=1);

namespace ExifReader\CameraData;

class ISOSpeed
{
    /** @var int */
    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function fromInt(int $value): self
    {
        if ($value < 0) {
            return self::undefined();
        }

        return new self($value);
    }

    public static function undefined(): self
    {
        return new self(0);
    }

    public function getIntValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}