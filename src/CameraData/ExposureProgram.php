<?php
declare(strict_types=1);

namespace ExifReader\CameraData;

use ExifReader\EnumerableInt;

class ExposureProgram
{
    use EnumerableInt;

    /** @var array<string> */
    private $list = [
        1 => 'Manual',
        2 => 'Normal program',
        3 => 'Aperture priority',
        4 => 'Shutter priority',
        5 => 'Creative program (biased toward depth of field)',
        6 => 'Action program (biased toward fast shutter speed)',
        7 => 'Portrait mode (for closeup photos with the background out of focus)',
        8 => 'Landscape mode (for landscape photos with the background in focus)',
    ];
}
