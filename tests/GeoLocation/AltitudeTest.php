<?php

declare(strict_types=1);

namespace ExifReader\Tests\GeoLocation;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\GeoLocation\Altitude;
use PHPUnit\Framework\TestCase;

class AltitudeTest extends TestCase
{
    use TestTrait;

    public function testItReturnsRightAltitude(): void
    {
        $this->forAll(Generator\pos(), Generator\pos())
            ->then(function(int $int1, int $int2) {
                $this->assertSame(
                    round($int1/$int2, 2),
                    (Altitude::fromString("{$int1}/{$int2}"))->getFloat()
                );
            });
    }

    /**
     * @dataProvider wrongAltitudeProvider
     */
    public function testItReturnsUndefinedAltitude(string $value): void
    {
        $this->assertSame(null, (Altitude::fromString($value))->getFloat());
    }

    public function wrongAltitudeProvider()
    {
        return [
            ['bla/bla'],
            ['123/bla'],
            ['bla/123'],
            ['bla'],
            [''],
            ['123'],
        ];
    }
}
