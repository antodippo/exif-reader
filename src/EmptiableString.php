<?php
declare(strict_types=1);

namespace ExifReader;

trait EmptiableString
{
    /** @var string */
    private $string;

    private function __construct(string $string)
    {
        $this->string = $string;
    }

    public static function fromString(string $string): self
    {
        return new self($string);
    }

    public static function undefined(): self
    {
        return new self('');
    }

    public function __toString(): string
    {
        return $this->string;
    }
}
