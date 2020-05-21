<?php
declare(strict_types=1);

namespace ExifReader;

trait EnumerableInt
{
    /** @var int */
    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function fromInt(int $value): self
    {
        return new self($value);
    }

    public static function undefined(): self
    {
        return new self(0);
    }

    public function __toString(): string
    {
        if (!array_key_exists($this->value, $this->list)) {
            return '';
        }

        return $this->list[$this->value];
    }
}
