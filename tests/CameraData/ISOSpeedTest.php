<?php

declare(strict_types=1);

namespace ExifReader\Tests\CameraData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\CameraData\ISOSpeed;
use PHPUnit\Framework\TestCase;

class ISOSpeedTest extends TestCase
{
    use TestTrait;

    public function testItReturnsIntValue(): void
    {
        $this->forAll(Generator\pos())
            ->then(function (int $value) {
                $this->assertSame($value, (ISOSpeed::fromInt($value))->getIntValue());
                $this->assertSame((string)$value, (string)ISOSpeed::fromInt($value));
            });
    }

    public function testItReturnsUndefined(): void
    {
        $this->assertSame(0, (ISOSpeed::fromInt(0))->getIntValue());

        $this->forAll(Generator\neg())
            ->then(function (int $value) {
                $this->assertSame(0, (ISOSpeed::fromInt($value))->getIntValue());
                $this->assertSame('0', (string)ISOSpeed::fromInt($value));
            });
    }
}
