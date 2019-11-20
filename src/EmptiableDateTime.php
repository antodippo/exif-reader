<?php
declare(strict_types=1);

namespace ExifReader;

use DateTimeImmutable;

abstract class EmptiableDateTime
{
    /** @var DateTimeImmutable|null */
    protected $dateTime;

    protected function __construct(?DateTimeImmutable $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function __toString(): string
    {
        if (! $this->dateTime instanceof DateTimeImmutable) {
            return '';
        }

        return (string)$this->dateTime->format('Y-m-d H:i:s');
    }

    public function getDateTime(): ?DateTimeImmutable
    {
        return $this->dateTime;
    }
}
