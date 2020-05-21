<?php
declare(strict_types=1);

namespace ExifReader\Tests\CameraData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\CameraData\ExposureProgram;
use PHPUnit\Framework\TestCase;

class ExposureProgramTest extends TestCase
{
    use TestTrait;

    /**
     * @dataProvider fileTypesProvider
     */
    public function testItReturnsString(int $fileTypeInt, string $expectedString): void
    {
        $fileType = ExposureProgram::fromInt($fileTypeInt);
        $this->assertSame($expectedString, (string)$fileType);
    }

    public function fileTypesProvider(): array
    {
        return [
            [ 0, ''],
            [ 1, 'Manual'],
            [ 2, 'Normal program'],
            [ 3, 'Aperture priority'],
            [ 4, 'Shutter priority'],
            [ 5, 'Creative program (biased toward depth of field)'],
            [ 6, 'Action program (biased toward fast shutter speed)'],
            [ 7, 'Portrait mode (for closeup photos with the background out of focus)'],
            [ 8, 'Landscape mode (for landscape photos with the background in focus)'],
        ];
    }

    public function testItReturnEmptyString(): void
    {
        $this->forAll(Generator\choose(19, 1000))
            ->then(function ($fileTypeInt) {
                $fileType = ExposureProgram::fromInt($fileTypeInt);
                $this->assertSame('', (string)$fileType);
            });

        $this->forAll(Generator\neg())
            ->then(function ($fileTypeInt) {
                $fileType = ExposureProgram::fromInt($fileTypeInt);
                $this->assertSame('', (string)$fileType);
            });
    }
}
