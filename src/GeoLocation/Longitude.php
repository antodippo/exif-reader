<?php
declare(strict_types=1);

namespace ExifReader\GeoLocation;

class Longitude
{
    use Coordinate;

    /** @var array<string> */
    private const AVAILABLE_REF = ['W', 'E'];

    /** @var int */
    private const BOUNDARY = 180;
}