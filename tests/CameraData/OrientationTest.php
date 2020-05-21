<?php
declare(strict_types=1);

namespace ExifReader\Tests\CameraData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\CameraData\Orientation;
use PHPUnit\Framework\TestCase;

class OrientationTest extends TestCase
{
    use TestTrait;

    /**
     * @dataProvider orientationProvider
     */
    public function testItReturnsString(int $fileTypeInt, string $expectedString): void
    {
        $fileType = Orientation::fromInt($fileTypeInt);
        $this->assertSame($expectedString, (string)$fileType);
    }

    public function orientationProvider(): array
    {
        return [
            [ 0, ''],
            [ 1, 'Standard'],
            [ 2, 'Mirrored'],
            [ 3, '180 degrees'],
            [ 4, '180 degrees, mirrored'],
            [ 5, '90 degrees'],
            [ 6, '90 degrees, mirrored'],
            [ 7, '270 degrees'],
            [ 8, '270 degrees, mirrored'],
        ];
    }

    public function testItReturnEmptyString(): void
    {
        $this->forAll(Generator\choose(9, 1000))
            ->then(function ($fileTypeInt) {
                $fileType = Orientation::fromInt($fileTypeInt);
                $this->assertSame('', (string)$fileType);
            });

        $this->forAll(Generator\neg())
            ->then(function ($fileTypeInt) {
                $fileType = Orientation::fromInt($fileTypeInt);
                $this->assertSame('', (string)$fileType);
            });
    }
}
