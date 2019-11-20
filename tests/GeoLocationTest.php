<?php
declare(strict_types=1);

namespace ExifReader\Tests;

use ExifReader\GeoLocation;
use PHPUnit\Framework\TestCase;

class GeoLocationTest extends TestCase
{
    /**
     * @dataProvider latitudeProvider
     */
    public function testLatitude(array $value, ?float $expected): void
    {
        $cameraData = GeoLocation::fromExifArray($value);
        $this->assertSame($expected, $cameraData->getLatitude()->getFloat());
    }

    public function latitudeProvider(): array
    {
        return [
            [
                [
                    'GPSLatitude' => [ '53/1', '20/1', '2147483642/72073277' ],
                    'GPSLatitudeRef' => 'N',
                ],
                53.341610
            ],
            [
                [
                    'GPSLatitude' => [ '53/1', '20/1', '2147483642/72073277' ],
                ],
                null
            ],
            [
                [
                    'GPSLatitudeRef' => 'N'
                ],
                null
            ],
            [
                [],
                null
            ],
        ];
    }

    /**
     * @dataProvider longitudeProvider
     */
    public function testLongitude(array $value, ?float $expected): void
    {
        $cameraData = GeoLocation::fromExifArray($value);
        $this->assertSame($expected, $cameraData->getLongitude()->getFloat());
    }

    public function longitudeProvider(): array
    {
        return [
            [
                [
                    'GPSLongitude' => [ '93/1', '20/1', '2147483642/72073277' ],
                    'GPSLongitudeRef' => 'E',
                ],
                93.341610
            ],
            [
                [
                    'GPSLongitude' => [ '53/1', '20/1', '2147483642/72073277' ],
                ],
                null
            ],
            [
                [
                    'GPSLongitudeRef' => 'N'
                ],
                null
            ],
            [
                [],
                null
            ],
        ];
    }

    /**
     * @dataProvider altitudeProvider
     */
    public function testAltitude(array $value, ?float $expected): void
    {
        $cameraData = GeoLocation::fromExifArray($value);
        $this->assertSame($expected, $cameraData->getAltitude()->getFloat());
    }

    public function altitudeProvider(): array
    {
        return [
            [
                [ 'GPSAltitude' => '123/1' ],
                123
            ],
            [
                [ 'GPSAltitude' => 'a string' ],
                null
            ],
            [
                [],
                null
            ],
        ];
    }
}
