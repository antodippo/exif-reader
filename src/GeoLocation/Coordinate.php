<?php
declare(strict_types=1);

namespace ExifReader\GeoLocation;

trait Coordinate
{
    /** @var float|null */
    private $floatCoordinate;

    private function __construct(?float $floatCoordinate)
    {
        $this->floatCoordinate = $floatCoordinate;
    }

    /** @param array<string> $coordinates */
    public static function fromExifArray(array $coordinates, string $ref): self
    {
        if (! self::guardRefIsValid($ref) || ! self::guardCoordinatesArrayIsValid($coordinates)) {
            return self::undefined();
        }

        $floatCoordinate = self::floatFromString((string) $coordinates[0])
            + (self::floatFromString((string) $coordinates[1]) / 60)
            + (self::floatFromString((string) $coordinates[2]) / 3600);

        if (! self::guardBoundaries($floatCoordinate)) {
            return self::undefined();
        }

        if ($ref === 'S' || $ref === 'W') {
            $floatCoordinate *= -1;
        }

        return new self($floatCoordinate);
    }

    public static function undefined(): self
    {
        return new self(null);
    }

    public function getFloat(): ?float
    {
        return $this->floatCoordinate ? round($this->floatCoordinate, 6) : null;
    }

    public function __toString(): string
    {
        return (string)$this->getFloat();
    }

    private static function floatFromString(string $string): float
    {
        $stringParts = explode('/', $string);

        return intval($stringParts[0]) / intval($stringParts[1]);
    }

    private static function guardRefIsValid(string $ref): bool
    {
        return in_array($ref, self::AVAILABLE_REF);
    }

    /** @param array<string> $coordinates */
    private static function guardCoordinatesArrayIsValid(array $coordinates): bool
    {
        if (count($coordinates) !== 3) {
            return false;
        }

        foreach ($coordinates as $coordinate) {
            if (strpos((string) $coordinate, '/') === false) {
                return false;
            }
            $coordinateParts = explode('/', (string) $coordinate);
            if (! is_numeric($coordinateParts[0]) || ! is_numeric($coordinateParts[1])) {
                return false;
            }
        }

        return true;
    }

    private static function guardBoundaries(float $coordinate): bool
    {
        return abs($coordinate) <= self::BOUNDARY;
    }
}