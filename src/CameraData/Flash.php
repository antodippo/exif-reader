<?php
declare(strict_types=1);

namespace ExifReader\CameraData;

use ExifReader\EnumerableInt;

class Flash
{
    use EnumerableInt;

    /** @var array<string> */
    private $list = [
        '0' => 'Flash did not fire',
        '1' => 'Flash fired',
        '5' => 'Strobe return light not detected',
        '7' => 'Strobe return light detected',
        '9' => 'Flash fired, compulsory flash mode',
        'd' => 'Flash fired, compulsory flash mode, return light not detected',
        'f' => 'Flash fired, compulsory flash mode, return light detected',
        '10' => 'Flash did not fire, compulsory flash mode',
        '18' => 'Flash did not fire, auto mode',
        '19' => 'Flash fired, auto mode',
        '1d' => 'Flash fired, auto mode, return light not detected',
        '1f' => 'Flash fired, auto mode, return light detected',
        '20' => 'No flash function',
        '41' => 'Flash fired, red-eye reduction mode',
        '45' => 'Flash fired, red-eye reduction mode, return light not detected',
        '47' => 'Flash fired, red-eye reduction mode, return light detected',
        '49' => 'Flash fired, compulsory flash mode, red-eye reduction mode',
        '4d' => 'Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected',
        '4f' => 'Flash fired, compulsory flash mode, red-eye reduction mode, return light detected',
        '59' => 'Flash fired, auto mode, red-eye reduction mode',
        '5d' => 'Flash fired, auto mode, return light not detected, red-eye reduction mode',
        '5f' => 'Flash fired, auto mode, return light detected, red-eye reduction mode',
    ];

    public function __toString(): string
    {
        $hexadecimalValue = dechex($this->value);
        if (!array_key_exists($hexadecimalValue, $this->list)) {
            return '';
        }

        return $this->list[$hexadecimalValue];
    }

    public static function undefined(): self
    {
        return new self(-1);
    }
}
