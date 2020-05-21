<?php
declare(strict_types=1);

namespace ExifReader;

use ExifReader\CameraData\Aperture;
use ExifReader\CameraData\ExposureProgram;
use ExifReader\CameraData\ExposureTime;
use ExifReader\CameraData\Flash;
use ExifReader\CameraData\FocalLength;
use ExifReader\CameraData\ISOSpeed;
use ExifReader\CameraData\Maker;
use ExifReader\CameraData\MakerNote;
use ExifReader\CameraData\Model;
use ExifReader\CameraData\Orientation;

class CameraData
{
    /** @var Maker */
    private $maker;

    /** @var Model */
    private $model;

    /** @var MakerNote */
    private $makerNote;

    /** @var Orientation */
    private $orientation;

    /** @var ExposureProgram */
    private $exposureProgram;

    /** @var ExposureTime */
    private $exposureTime;

    /** @var FocalLength */
    private $focalLength;

    /** @var Flash */
    private $flash;

    /** @var Aperture */
    private $aperture;

    /** @var ISOSpeed */
    private $ISOSpeed;

    private function __construct(
        Maker $maker,
        Model $model,
        MakerNote $makerNote,
        Orientation $orientation,
        ExposureProgram $exposureProgram,
        ExposureTime $exposureTime,
        FocalLength $focalLength,
        Flash $flash,
        Aperture $aperture,
        ISOSpeed $ISOSpeed
    ) {
        $this->maker = $maker;
        $this->model = $model;
        $this->makerNote = $makerNote;
        $this->orientation = $orientation;
        $this->exposureProgram = $exposureProgram;
        $this->exposureTime = $exposureTime;
        $this->focalLength = $focalLength;
        $this->flash = $flash;
        $this->aperture = $aperture;
        $this->ISOSpeed = $ISOSpeed;
    }

    public static function fromExifArray(array $exifArray): self
    {
        return new self(
            isset($exifArray['Make']) ? Maker::fromString((string) $exifArray['Make']) : Maker::undefined(),
            isset($exifArray['Model']) ? Model::fromString((string) $exifArray['Model']) : Model::undefined(),
            isset($exifArray['MakerNote']) ? MakerNote::fromString((string) $exifArray['MakerNote']) : MakerNote::undefined(),
            isset($exifArray['Orientation']) && is_int($exifArray['Orientation']) ? Orientation::fromInt($exifArray['Orientation']) : Orientation::undefined(),
            isset($exifArray['ExposureProgram']) && is_int($exifArray['ExposureProgram']) ? ExposureProgram::fromInt($exifArray['ExposureProgram']) : ExposureProgram::undefined(),
            isset($exifArray['ExposureTime']) ? ExposureTime::fromExifRational((string) (string) $exifArray['ExposureTime']) : ExposureTime::undefined(),
            isset($exifArray['FocalLength']) ? FocalLength::fromExifRational((string) $exifArray['FocalLength']) : FocalLength::undefined(),
            isset($exifArray['Flash']) && is_int($exifArray['Flash']) ? Flash::fromInt($exifArray['Flash']) : Flash::undefined(),
            isset($exifArray['ApertureValue']) ? Aperture::fromExifRational((string) $exifArray['ApertureValue']) : Aperture::undefined(),
            isset($exifArray['ISOSpeedRatings']) && is_numeric($exifArray['ISOSpeedRatings']) ? ISOSpeed::fromInt((int)$exifArray['ISOSpeedRatings']) : ISOSpeed::undefined()
        );
    }

    public function getMaker(): Maker
    {
        return $this->maker;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function getMakerNote(): MakerNote
    {
        return $this->makerNote;
    }

    public function getOrientation(): Orientation
    {
        return $this->orientation;
    }

    public function getExposureProgram(): ExposureProgram
    {
        return $this->exposureProgram;
    }

    public function getExposureTime(): ExposureTime
    {
        return $this->exposureTime;
    }

    public function getFocalLength(): FocalLength
    {
        return $this->focalLength;
    }

    public function getFlash(): Flash
    {
        return $this->flash;
    }

    public function getAperture(): Aperture
    {
        return $this->aperture;
    }

    public function getISOSpeed(): ISOSpeed
    {
        return $this->ISOSpeed;
    }
}