<?php
declare(strict_types=1);

namespace ExifReader\FileData;

use DateTimeImmutable;
use ExifReader\EmptiableDateTime;

class LastModifiedDate extends EmptiableDateTime
{
    public const FORMAT = 'Y:m:d H:i:s';

    public static function fromString(string $dateTime): self
    {
        return new self(DateTimeImmutable::createFromFormat(self::FORMAT, $dateTime) ?: null);
    }

    public static function undefined(): self
    {
        return new self(null);
    }
}
