<?php
declare(strict_types=1);

namespace ExifReader\FileData;

use ExifReader\EmptiableDateTime;

class FileDateTime extends EmptiableDateTime
{
    public static function fromTimestamp(int $timestamp): self
    {
        return new self((new \DateTimeImmutable())->setTimestamp($timestamp));
    }

    public static function undefined(): self
    {
        return new self(null);
    }
}
