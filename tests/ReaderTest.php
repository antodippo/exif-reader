<?php
declare(strict_types=1);

namespace ExifReader\Tests;

use ExifReader\CameraData\ISOSpeed;
use ExifReader\CameraData\Model;
use ExifReader\CannotReadExifData;
use ExifReader\FileData\FileDateTime;
use ExifReader\FileData\TakenDate;
use ExifReader\GeoLocation\Latitude;
use ExifReader\Reader;
use PHPUnit\Framework\TestCase;

class ReaderTest extends TestCase
{
    /**
     * @dataProvider fileProvider
     */
    public function testRead(
        string $filename,
        TakenDate $takenDate,
        Model $model,
        ISOSpeed $ISOSpeed,
        Latitude $latitude
    ): void {
        $exifData = (new Reader())->read(__DIR__ . '/images/' . $filename);

        $this->assertEquals($takenDate, $exifData->getFileData()->getTakenDate());
        $this->assertEquals($model, $exifData->getCameraData()->getModel());
        $this->assertEquals($ISOSpeed, $exifData->getCameraData()->getISOSpeed());
        $this->assertEquals($latitude, $exifData->getGeoLocation()->getLatitude());
    }

    public function fileProvider(): array
    {
        return [
            [
                'canon-eos-650d.jpg',
                TakenDate::fromString('2017:06:16 14:30:44'),
                Model::fromString('Canon EOS 650D'),
                ISOSpeed::fromInt(1250),
                Latitude::undefined()
            ],
            [
                'no-exif.jpg',
                TakenDate::undefined(),
                Model::undefined(),
                ISOSpeed::undefined(),
                Latitude::undefined()
            ],
            [
                'no-coordinates.jpg',
                TakenDate::fromString('2017:03:26 14:31:47'),
                Model::fromString('F5121'),
                ISOSpeed::fromInt(40),
                Latitude::undefined()
            ],
            [
                'misplaced-exif.jpg',
                TakenDate::undefined(),
                Model::undefined(),
                ISOSpeed::undefined(),
                Latitude::undefined()
            ],
            [
                'olympus-c5050z.jpg',
                TakenDate::fromString('0000:00:00 00:00:00'),
                Model::fromString('C5050Z'),
                ISOSpeed::fromInt(64),
                Latitude::undefined()
            ],
            [
                'with-coordinates.jpg',
                TakenDate::fromString('2017:06:09 18:43:32'),
                Model::fromString('F5121'),
                ISOSpeed::fromInt(40),
                Latitude::fromExifArray(['64/1', '15/1', '28223/1000'], 'N')
            ],
        ];
    }

    public function testItThrowsException()
    {
        $this->expectException(CannotReadExifData::class);
        $this->expectExceptionMessage('');
        $exifData = (new Reader())->read(__DIR__ . '/images/iPhone.HEIC');
    }

    public function testItThrowsExceptionWhenFileNotExists()
    {
        $this->expectException(CannotReadExifData::class);
        $this->expectExceptionMessage('');
        $exifData = (new Reader())->read(__DIR__ . '/images/no-file');
    }
}
