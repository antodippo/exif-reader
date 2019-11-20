<?php
declare(strict_types=1);

namespace ExifReader\Tests;

use ExifReader\CameraData;
use ExifReader\ExifData;
use ExifReader\FileData;
use ExifReader\GeoLocation;
use PHPUnit\Framework\TestCase;

class ExifDataTest extends TestCase
{
    public function testFileData(): void
    {
        $exifData = ExifData::fromExifArray([]);
        $this->assertInstanceOf(FileData::class, $exifData->getFileData());
    }

    public function testCameraData(): void
    {
        $exifData = ExifData::fromExifArray([]);
        $this->assertInstanceOf(CameraData::class, $exifData->getCameraData());
    }

    public function testGeoLocation(): void
    {
        $exifData = ExifData::fromExifArray([]);
        $this->assertInstanceOf(GeoLocation::class, $exifData->getGeoLocation());
    }
}
