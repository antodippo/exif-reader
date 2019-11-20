<?php
declare(strict_types=1);

namespace ExifReader\Tests\GeoLocation;

use ExifReader\GeoLocation\Longitude;
use PHPUnit\Framework\TestCase;

class LongitudeTest extends TestCase
{
    /** @dataProvider coordinatesProvider */
    public function testItReturnsFloat(array $coordinates, string $ref, ?float $expectedValue): void
    {
        $geoCoordinate = Longitude::fromExifArray($coordinates, $ref);
        $this->assertSame($expectedValue, $geoCoordinate->getFloat());
    }

    public function coordinatesProvider(): array
    {
        return [
            [
                [ '93/1', '20/1', '2147483642/72073277' ],
                'E',
                93.341610
            ],
            [
                [ '6/1', '17/1', '2147483638/193835267' ],
                'W',
                -6.286411
            ],
            [
                [ '53/1', '20/1' ],
                'E',
                null
            ],
            [
                [ '123', '20/1', '2147483642/72073277' ],
                'E',
                null
            ],
            [
                [ '53/1', '12', '2147483642/72073277' ],
                'E',
                null
            ],
            [
                [ '53/1', '20/1', '12' ],
                'E',
                null
            ],
            [
                [ '53/1', '20/1', '2147483642/72073277' ],
                '',
                null
            ],
            [
                [ '53/1', '20/1', '2147483642/72073277' ],
                'X',
                null
            ],
            [
                [ 'bla/123', '20/1', '2147483642/72073277' ],
                'E',
                null
            ],
            [
                [ '123/bla', '20/1', '2147483642/72073277' ],
                'E',
                null
            ],
            [
                [ '180/1', '20/1', '2147483642/72073277' ],
                'E',
                null
            ],
            [
                [ '180/1', '0/1', '0/1' ],
                'E',
                180.0
            ],
        ];
    }

    public function testItReturnsEmptyString(): void
    {
        $this->assertNull((Longitude::undefined())->getFloat());
    }
}
