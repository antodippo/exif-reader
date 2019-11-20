<?php
declare(strict_types=1);

namespace ExifReader\Tests\FileData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\FileData\FileSize;
use PHPUnit\Framework\TestCase;

class FileSizeTest extends TestCase
{
    use TestTrait;

    public function testItReturnsIntValue(): void
    {
        $this->forAll(Generator\pos())
            ->then(function (int $value) {
                $this->assertSame($value, (FileSize::fromInt($value))->getIntValue());
                $this->assertSame((string)$value, (string)FileSize::fromInt($value));
            });
    }

    public function testItReturnsUndefined(): void
    {
        $this->assertSame(0, (FileSize::fromInt(0))->getIntValue());

        $this->forAll(Generator\neg())
            ->then(function (int $value) {
                $this->assertSame(0, (FileSize::fromInt($value))->getIntValue());
                $this->assertSame('0', (string)FileSize::fromInt($value));
            });
    }
}
