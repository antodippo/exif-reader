<?php
declare(strict_types=1);

namespace ExifReader\Tests;

use ExifReader\CameraData;
use PHPUnit\Framework\TestCase;

class CameraDataTest extends TestCase
{
    /**
     * @dataProvider makerProvider
     */
    public function testMaker(array $value, string $expected): void
    {
        $cameraData = CameraData::fromExifArray($value);
        $this->assertSame($expected, (string)$cameraData->getMaker());
    }

    public function makerProvider(): array
    {
        return [
            [['Make' => 'Test'], 'Test'],
            [['Make' => ''], ''],
            [['Make' => null], ''],
            [[], ''],
        ];
    }

    /**
     * @dataProvider modelProvider
     */
    public function testModel(array $value, string $expected): void
    {
        $cameraData = CameraData::fromExifArray($value);
        $this->assertSame($expected, (string)$cameraData->getModel());
    }

    public function modelProvider(): array
    {
        return [
            [['Model' => 'Test'], 'Test'],
            [['Model' => ''], ''],
            [['Model' => null], ''],
            [[], ''],
        ];
    }

    /**
     * @dataProvider makerNoteProvider
     */
    public function testMakerNote(array $value, string $expected): void
    {
        $cameraData = CameraData::fromExifArray($value);
        $this->assertSame($expected, (string)$cameraData->getMakerNote());
    }

    public function makerNoteProvider(): array
    {
        return [
            [['MakerNote' => 'Test'], 'Test'],
            [['MakerNote' => ''], ''],
            [['MakerNote' => null], ''],
            [[], ''],
        ];
    }

    /**
     * @dataProvider orientationProvider
     */
    public function testOrientation(array $value, string $expected): void
    {
        $cameraData = CameraData::fromExifArray($value);
        $this->assertSame($expected, (string)$cameraData->getOrientation());
    }

    public function orientationProvider(): array
    {
        return [
            [['Orientation' => 1], 'Standard'],
            [['Orientation' => 9], ''],
            [['Orientation' => 'a string'], ''],
            [['Orientation' => null], ''],
            [[], ''],
        ];
    }

    /**
     * @dataProvider exposureProgramProvider
     */
    public function testExposureProgram(array $value, string $expected): void
    {
        $cameraData = CameraData::fromExifArray($value);
        $this->assertSame($expected, (string)$cameraData->getExposureProgram());
    }

    public function exposureProgramProvider(): array
    {
        return [
            [['ExposureProgram' => 1], 'Manual'],
            [['ExposureProgram' => 9], ''],
            [['ExposureProgram' => 'a string'], ''],
            [['ExposureProgram' => null], ''],
            [[], ''],
        ];
    }

    /**
     * @dataProvider exposureTimeProvider
     */
    public function testExposureTime(array $value, string $expected): void
    {
        $cameraData = CameraData::fromExifArray($value);
        $this->assertSame($expected, (string)$cameraData->getExposureTime());
    }

    public function exposureTimeProvider(): array
    {
        return [
            [['ExposureTime' => '15/10'], '1.5'],
            [['ExposureTime' => 'a string'], ''],
            [['ExposureTime' => ''], ''],
            [['ExposureTime' => null], ''],
            [[], ''],
        ];
    }

    /**
     * @dataProvider focalLengthProvider
     */
    public function testFocalLength(array $value, string $expected): void
    {
        $cameraData = CameraData::fromExifArray($value);
        $this->assertSame($expected, (string)$cameraData->getFocalLength());
    }

    public function focalLengthProvider(): array
    {
        return [
            [['FocalLength' => '15/10'], '1.5'],
            [['FocalLength' => 'a string'], ''],
            [['FocalLength' => ''], ''],
            [['FocalLength' => null], ''],
            [[], ''],
        ];
    }

    /**
     * @dataProvider flashProvider
     */
    public function testFlash(array $value, string $expected): void
    {
        $cameraData = CameraData::fromExifArray($value);
        $this->assertSame($expected, (string)$cameraData->getFlash());
    }

    public function flashProvider(): array
    {
        return [
            [['Flash' => 0], 'Flash did not fire'],
            [['Flash' => 99], ''],
            [['Flash' => 'a string'], ''],
            [['Flash' => null], ''],
            [[], ''],
        ];
    }

    /**
     * @dataProvider apertureValueProvider
     */
    public function testAperture(array $value, string $expected): void
    {
        $cameraData = CameraData::fromExifArray($value);
        $this->assertSame($expected, (string)$cameraData->getAperture());
    }

    public function apertureValueProvider(): array
    {
        return [
            [['ApertureValue' => '15/10'], 'f/1.5'],
            [['ApertureValue' => 'a string'], 'f/'],
            [['ApertureValue' => ''], 'f/'],
            [['ApertureValue' => null], 'f/'],
            [[], 'f/'],
        ];
    }

    /**
     * @dataProvider ISOSpeedRatingsProvider
     */
    public function testISOSpeedRatings(array $value, int $expected): void
    {
        $cameraData = CameraData::fromExifArray($value);
        $this->assertSame($expected, $cameraData->getISOSpeed()->getIntValue());
    }

    public function ISOSpeedRatingsProvider(): array
    {
        return [
            [['ISOSpeedRatings' => 123123], 123123],
            [['ISOSpeedRatings' => '123123'], 123123],
            [['ISOSpeedRatings' => 123123.123], 123123],
            [['ISOSpeedRatings' => 'a wrong string'], 0],
            [['ISOSpeedRatings' => ''], 0],
            [['ISOSpeedRatings' => null], 0],
            [[], 0],
        ];
    }
}
