<?php
declare(strict_types=1);

namespace ExifReader\Tests\FileData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\FileData\TakenDate;
use PHPUnit\Framework\TestCase;

class TakenDateTest extends TestCase
{
    use TestTrait;

    public function testItReturnsCorrectString(): void
    {
        $this->forAll(Generator\date())
            ->then(function (\DateTime $datetime) {
                $takenDate = TakenDate::fromString($datetime->format(TakenDate::FORMAT));
                $this->assertSame($datetime->format('Y-m-d H:i:s'), (string)$takenDate);
                $this->assertEquals($datetime, $takenDate->getDateTime());
            });
    }

    public function testItReturnsEmptyString(): void
    {
        $this->assertSame('', (string)TakenDate::undefined());
    }
}
