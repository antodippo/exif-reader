<?php
declare(strict_types=1);

namespace ExifReader\Tests\FileData;

use Eris\Generator;
use Eris\TestTrait;
use ExifReader\FileData\LastModifiedDate;
use PHPUnit\Framework\TestCase;

class LastModifiedDateTest extends TestCase
{
    use TestTrait;

    public function testItReturnsCorrectString(): void
    {
        $this->forAll(Generator\date())
            ->then(function (\DateTime $datetime) {
                $this->assertSame(
                    $datetime->format('Y-m-d H:i:s'),
                    (string)LastModifiedDate::fromString($datetime->format(LastModifiedDate::FORMAT))
                );
            });
    }

    public function testItReturnsEmptyString(): void
    {
        $this->assertSame('', (string)LastModifiedDate::undefined());
    }
}
