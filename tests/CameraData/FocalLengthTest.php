<?php
declare(strict_types=1);

namespace ExifReader\Tests\CameraData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\CameraData\FocalLength;
use PHPUnit\Framework\TestCase;

class FocalLengthTest extends TestCase
{
    use TestTrait;

    public function testItReturnsCorrectString(): void
    {
        $this->forAll(Generator\pos(), Generator\pos())
            ->then(function ($int1, $int2) {
                $this->assertSame(
                    (float)(intval($int1) / intval($int2)),
                    (FocalLength::fromExifRational("{$int1}/{$int2}"))->getFloatValue()
                );
            });
    }

    public function testItReturnsAnEmptyString(): void
    {
        $this->assertSame('', (string)FocalLength::undefined());
    }
}
