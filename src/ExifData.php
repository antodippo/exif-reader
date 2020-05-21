<?php
declare(strict_types=1);

namespace ExifReader;

class ExifData
{
    /** @var FileData */
    private $fileData;

    /** @var CameraData */
    private $cameraData;

    /** @var GeoLocation */
    private $geoLocation;

    public function __construct(
        FileData $fileData,
        CameraData $cameraData,
        GeoLocation $geoLocation
    ) {
        $this->fileData = $fileData;
        $this->cameraData = $cameraData;
        $this->geoLocation = $geoLocation;
    }

    public static function fromExifArray(array $exifArray): self
    {
        return new self(
            FileData::fromExifArray($exifArray),
            CameraData::fromExifArray($exifArray),
            GeoLocation::fromExifArray($exifArray)
        );
    }

    public function getFileData(): FileData
    {
        return $this->fileData;
    }

    public function getCameraData(): CameraData
    {
        return $this->cameraData;
    }

    public function getGeoLocation(): GeoLocation
    {
        return $this->geoLocation;
    }
}
