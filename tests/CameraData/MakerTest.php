<?php
declare(strict_types=1);

namespace ExifReader\Tests\CameraData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\CameraData\Maker;
use PHPUnit\Framework\TestCase;

class MakerTest extends TestCase
{
    use TestTrait;

    public function testItReturnsCorrectString(): void
    {
        $this->forAll(Generator\string())
            ->then(function ($string) {
                $this->assertSame($string, (string)Maker::fromString($string));
            });
    }

    public function testItReturnsAnEmptyString(): void
    {
        $this->assertSame('', (string)Maker::undefined());
    }
}
