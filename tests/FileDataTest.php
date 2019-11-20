<?php
declare(strict_types=1);

namespace ExifReader\Tests;

use ExifReader\FileData;
use ExifReader\FileData\FileDateTime;
use ExifReader\FileData\LastModifiedDate;
use ExifReader\FileData\TakenDate;
use PHPUnit\Framework\TestCase;

class FileDataTest extends TestCase
{
    /**
     * @dataProvider fileNameProvider
     */
    public function testFileName(array $value, string $expected): void
    {
        $fileData = FileData::fromExifArray($value);
        $this->assertSame($expected, (string)$fileData->getFilename());
    }

    public function fileNameProvider(): array
    {
        return [
            [['FileName' => 'filename.jpg'], 'filename.jpg'],
            [['FileName' => ''], ''],
            [['FileName' => null], ''],
            [[], ''],
        ];
    }

    /**
     * @dataProvider fileDateTimeProvider
     */
    public function testFileDateTime(array $value, FileDateTime $expected): void
    {
        $fileData = FileData::fromExifArray($value);
        $this->assertEquals($expected, $fileData->getFileDateTime());
    }

    public function fileDateTimeProvider(): array
    {
        return [
            [['FileDateTime' => 1572008673], FileDateTime::fromTimestamp(1572008673)],
            [['FileDateTime' => 'a string'], FileDateTime::undefined()],
            [['FileDateTime' => 12.34], FileDateTime::undefined()],
            [['FileDateTime' => null], FileDateTime::undefined()],
            [[], FileDateTime::undefined()],
        ];
    }

    /**
     * @dataProvider lastModifiedDateProvider
     */
    public function testLastModifiedDate(array $value, LastModifiedDate $expected): void
    {
        $fileData = FileData::fromExifArray($value);
        $this->assertEquals($expected, $fileData->getLastModifiedDate());
    }

    public function lastModifiedDateProvider(): array
    {
        return [
            [['DateTime' => '2005:01:26 14:32:50'], LastModifiedDate::fromString('2005:01:26 14:32:50')],
            [['DateTime' => 'a wrong string'], LastModifiedDate::undefined()],
            [['DateTime' => ''], LastModifiedDate::undefined()],
            [['DateTime' => '1234'], LastModifiedDate::undefined()],
            [[], LastModifiedDate::undefined()],
        ];
    }

    /**
     * @dataProvider takenAtProvider
     */
    public function testTakenAt(array $value, TakenDate $expected): void
    {
        $fileData = FileData::fromExifArray($value);
        $this->assertEquals($expected, $fileData->getTakenDate());
    }

    public function takenAtProvider(): array
    {
        return [
            [['DateTimeOriginal' => '2005:01:26 14:32:50'], TakenDate::fromString('2005:01:26 14:32:50')],
            [['DateTimeOriginal' => 'a wrong string'], TakenDate::undefined()],
            [['DateTimeOriginal' => ''], TakenDate::undefined()],
            [['DateTimeOriginal' => '1234'], TakenDate::undefined()],
            [[], TakenDate::undefined()],
        ];
    }

    /**
     * @dataProvider fileSizeProvider
     */
    public function testFileSize(array $value, int $expected): void
    {
        $fileData = FileData::fromExifArray($value);
        $this->assertSame($expected, $fileData->getFileSize()->getIntValue());
    }

    public function fileSizeProvider(): array
    {
        return [
            [['FileSize' => '123123'], 123123],
            [['FileSize' => 123123], 123123],
            [['FileSize' => 123123.123], 123123],
            [['FileSize' => 'a wrong string'], 0],
            [['FileSize' => ''], 0],
            [['FileSize' => null], 0],
            [[], 0],
        ];
    }

    /**
     * @dataProvider fileTypeProvider
     */
    public function testFileType(array $value, string $expected): void
    {
        $fileData = FileData::fromExifArray($value);
        $this->assertSame($expected, (string)$fileData->getFileType());
    }

    public function fileTypeProvider(): array
    {
        return [
            [['FileType' => 2], 'JPEG'],
            [['FileType' => '2'], 'JPEG'],
            [['FileType' => 123123.123], ''],
            [['FileType' => 'a string'], ''],
            [['FileType' => ''], ''],
            [['FileType' => null], ''],
            [[], ''],
        ];
    }

}
