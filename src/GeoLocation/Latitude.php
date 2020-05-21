<?php
declare(strict_types=1);

namespace ExifReader\GeoLocation;

class Latitude
{
    use Coordinate;

    /** @var array<string> */
    private const AVAILABLE_REF = ['N', 'S'];

    /** @var int */
    private const BOUNDARY = 90;
}
