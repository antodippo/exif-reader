<?php
declare(strict_types=1);

namespace ExifReader\Tests\FileData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\FileData\FileType;
use PHPUnit\Framework\TestCase;

class FileTypeTest extends TestCase
{
    use TestTrait;

    /**
     * @dataProvider fileTypesProvider
     */
    public function testItReturnsString(int $fileTypeInt, string $expectedString): void
    {
        $fileType = FileType::fromInt($fileTypeInt);
        $this->assertSame($expectedString, (string)$fileType);
    }

    public function fileTypesProvider(): array
    {
        return [
            [ 0, ''],
            [ 1, 'GIF'],
            [ 2, 'JPEG'],
            [ 3, 'PNG'],
            [ 4, 'SWF'],
            [ 5, 'PSD'],
            [ 6, 'BMP'],
            [ 7, 'TIFF (Intel)'],
            [ 8, 'TIFF (Motorola)'],
            [ 9, 'JPC/JPEG2000'],
            [ 10, 'JP2'],
            [ 11, 'JPX'],
            [ 12, 'JB2'],
            [ 13, 'SWC'],
            [ 14, 'IFF'],
            [ 15, 'WBMP'],
            [ 16, 'XBM'],
            [ 17, 'ICO'],
            [ 18, 'WEBP'],
        ];
    }

    public function testItReturnEmptyString(): void
    {
        $this->forAll(Generator\choose(19, 1000))
            ->then(function($fileTypeInt) {
                $fileType = FileType::fromInt($fileTypeInt);
                $this->assertSame('', (string)$fileType);
            });

        $this->forAll(Generator\neg())
            ->then(function($fileTypeInt) {
                $fileType = FileType::fromInt($fileTypeInt);
                $this->assertSame('', (string)$fileType);
            });
    }
}
