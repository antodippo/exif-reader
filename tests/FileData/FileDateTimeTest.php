<?php
declare(strict_types=1);

namespace ExifReader\Tests\FileData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\FileData\FileDateTime;
use PHPUnit\Framework\TestCase;

class FileDateTimeTest extends TestCase
{
    use TestTrait;

    public function testItReturnsCorrectString(): void
    {
        $this->forAll(Generator\date())
            ->then(function (\DateTime $datetime) {
                $this->assertSame(
                    $datetime->format('Y-m-d H:i:s'),
                    (string)FileDateTime::fromTimestamp($datetime->getTimestamp())
                );
            });
    }

    public function testItReturnsEmptyString(): void
    {
        $this->assertSame('', (string)FileDateTime::undefined());
    }
}
