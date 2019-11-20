<?php
declare(strict_types=1);

namespace ExifReader\Tests\GeoLocation;

use ExifReader\GeoLocation\Latitude;
use PHPUnit\Framework\TestCase;

class LatitudeTest extends TestCase
{
    /** @dataProvider coordinatesProvider */
    public function testItReturnsFloat(array $coordinates, string $ref, ?float $expectedValue): void
    {
        $geoCoordinate = Latitude::fromExifArray($coordinates, $ref);
        $this->assertSame($expectedValue, $geoCoordinate->getFloat());
    }

    public function coordinatesProvider(): array
    {
        return [
            [
                [ '53/1', '20/1', '2147483642/72073277' ],
                'N',
                53.341610
            ],
            [
                [ '6/1', '17/1', '2147483638/193835267' ],
                'S',
                -6.286411
            ],
            [
                [ '53/1', '20/1' ],
                'N',
                null
            ],
            [
                [ '123', '20/1', '2147483642/72073277' ],
                'N',
                null
            ],
            [
                [ '53/1', '12', '2147483642/72073277' ],
                'N',
                null
            ],
            [
                [ '53/1', '20/1', '12' ],
                'N',
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
                'N',
                null
            ],
            [
                [ '123/bla', '20/1', '2147483642/72073277' ],
                'N',
                null
            ],
            [
                [ '90/1', '20/1', '2147483642/72073277' ],
                'N',
                null
            ],
            [
                [ '90/1', '0/1', '0/1' ],
                'N',
                90.0
            ],
        ];
    }

    public function testItReturnsEmptyString(): void
    {
        $this->assertNull((Latitude::undefined())->getFloat());
    }
}
