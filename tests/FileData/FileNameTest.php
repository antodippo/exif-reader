<?php
declare(strict_types=1);

namespace ExifReader\Tests\FileData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\FileData\FileName;
use PHPUnit\Framework\TestCase;

class FileNameTest extends TestCase
{
    use TestTrait;

    public function testItReturnsCorrectString(): void
    {
        $this->forAll(Generator\string())
            ->then(function ($name) {
                $this->assertSame($name, (string)FileName::fromString($name));
            });
    }

    public function testItReturnsAnEmptyString(): void
    {
        $this->assertSame('', (string)FileName::undefined());
    }
}
