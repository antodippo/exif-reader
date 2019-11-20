<?php
declare(strict_types=1);

namespace ExifReader\Tests\FileData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\CameraData\Model;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    use TestTrait;

    public function testItReturnsCorrectString(): void
    {
        $this->forAll(Generator\string())
            ->then(function ($string) {
                $this->assertSame($string, (string)Model::fromString($string));
            });
    }

    public function testItReturnsAnEmptyString(): void
    {
        $this->assertSame('', (string)Model::undefined());
    }
}
