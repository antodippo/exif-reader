<?php
declare(strict_types=1);

namespace ExifReader\Tests\CameraData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\CameraData\Flash;
use PHPUnit\Framework\TestCase;

class FlashTest extends TestCase
{
    use TestTrait;

    /**
     * @dataProvider fileTypesProvider
     */
    public function testItReturnsString(int $fileTypeInt, string $expectedString): void
    {
        $fileType = Flash::fromInt($fileTypeInt);
        $this->assertSame($expectedString, (string)$fileType);
    }

    public function fileTypesProvider(): array
    {
        return [
            [ hexdec('0'), 'Flash did not fire'],
            [ hexdec('1'), 'Flash fired'],
            [ hexdec('5'), 'Strobe return light not detected'],
            [ hexdec('7'), 'Strobe return light detected'],
            [ hexdec('9'), 'Flash fired, compulsory flash mode'],
            [ hexdec('d'), 'Flash fired, compulsory flash mode, return light not detected'],
            [ hexdec('f'), 'Flash fired, compulsory flash mode, return light detected'],
            [ hexdec('10'), 'Flash did not fire, compulsory flash mode'],
            [ hexdec('18'), 'Flash did not fire, auto mode'],
            [ hexdec('19'), 'Flash fired, auto mode'],
            [ hexdec('1d'), 'Flash fired, auto mode, return light not detected'],
            [ hexdec('1f'), 'Flash fired, auto mode, return light detected'],
            [ hexdec('20'), 'No flash function'],
            [ hexdec('41'), 'Flash fired, red-eye reduction mode'],
            [ hexdec('45'), 'Flash fired, red-eye reduction mode, return light not detected'],
            [ hexdec('47'), 'Flash fired, red-eye reduction mode, return light detected'],
            [ hexdec('49'), 'Flash fired, compulsory flash mode, red-eye reduction mode'],
            [ hexdec('4d'), 'Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected'],
            [ hexdec('4f'), 'Flash fired, compulsory flash mode, red-eye reduction mode, return light detected'],
            [ hexdec('59'), 'Flash fired, auto mode, red-eye reduction mode'],
            [ hexdec('5d'), 'Flash fired, auto mode, return light not detected, red-eye reduction mode'],
            [ hexdec('5f'), 'Flash fired, auto mode, return light detected, red-eye reduction mode'],
        ];
    }

    public function testItReturnEmptyString(): void
    {
        $this->forAll(Generator\choose(hexdec('5f') + 1, 1000))
            ->then(function($fileTypeInt) {
                $fileType = Flash::fromInt($fileTypeInt);
                $this->assertSame('', (string)$fileType);
            });

        $this->forAll(Generator\neg())
            ->then(function($fileTypeInt) {
                $fileType = Flash::fromInt($fileTypeInt);
                $this->assertSame('', (string)$fileType);
            });
    }
}
