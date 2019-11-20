<?php
declare(strict_types=1);

namespace ExifReader\Tests\FileData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\CameraData\MakerNote;
use PHPUnit\Framework\TestCase;

class MakerNoteTest extends TestCase
{
    use TestTrait;

    public function testItReturnsCorrectString(): void
    {
        $this->forAll(Generator\string())
            ->then(function ($string) {
                $this->assertSame($string, (string)MakerNote::fromString($string));
            });
    }

    public function testItReturnsAnEmptyString(): void
    {
        $this->assertSame('', (string)MakerNote::undefined());
    }
}
