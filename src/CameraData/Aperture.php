<?php
declare(strict_types=1);

namespace ExifReader\CameraData;

use ExifReader\ExifRational;

class Aperture
{
    use ExifRational;

    public function __toString(): string
    {
        return 'f/' . (string)$this->floatValue;
    }
}