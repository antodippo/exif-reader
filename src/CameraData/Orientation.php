<?php
declare(strict_types=1);

namespace ExifReader\CameraData;

use ExifReader\EnumerableInt;

class Orientation
{
    use EnumerableInt;

    /** @var array<string> */
    private $list = [
        1 => 'Standard',
        2 => 'Mirrored',
        3 => '180 degrees',
        4 => '180 degrees, mirrored',
        5 => '90 degrees',
        6 => '90 degrees, mirrored',
        7 => '270 degrees',
        8 => '270 degrees, mirrored',
    ];
}
