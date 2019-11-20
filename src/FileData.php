<?php
declare(strict_types=1);

namespace ExifReader;

use ExifReader\FileData\FileDateTime;
use ExifReader\FileData\FileName;
use ExifReader\FileData\FileSize;
use ExifReader\FileData\FileType;
use ExifReader\FileData\LastModifiedDate;
use ExifReader\FileData\TakenDate;

class FileData
{
    /** @var FileName */
    private $fileName;

    /** @var FileDateTime */
    private $fileDateTime;

    /** @var LastModifiedDate */
    private $lastModifiedDate;

    /** @var TakenDate */
    private $takenDate;

    /** @var FileSize */
    private $fileSize;

    /** @var FileType */
    private $fileType;

    private function __construct(
        FileName $fileName,
        FileDateTime $fileDateTime,
        LastModifiedDate $lastModifiedDate,
        TakenDate $takenDate,
        FileSize $fileSize,
        FileType $fileType
    ) {
        $this->fileName = $fileName;
        $this->fileSize = $fileSize;
        $this->fileType = $fileType;
        $this->fileDateTime = $fileDateTime;
        $this->lastModifiedDate = $lastModifiedDate;
        $this->takenDate = $takenDate;
    }

    public static function fromExifArray(array $exifArray): self
    {
        return new self(
            isset($exifArray['FileName']) ? FileName::fromString($exifArray['FileName']) : FileName::undefined(),
            isset($exifArray['FileDateTime']) && is_int($exifArray['FileDateTime']) ? FileDateTime::fromTimestamp($exifArray['FileDateTime']) : FileDateTime::undefined(),
            isset($exifArray['DateTime']) ? LastModifiedDate::fromString($exifArray['DateTime']) : LastModifiedDate::undefined(),
            isset($exifArray['DateTimeOriginal']) ? TakenDate::fromString($exifArray['DateTimeOriginal']) : TakenDate::undefined(),
            isset($exifArray['FileSize']) && is_numeric($exifArray['FileSize']) ? FileSize::fromInt((int)$exifArray['FileSize']) : FileSize::undefined(),
            isset($exifArray['FileType']) && is_numeric($exifArray['FileType']) ? FileType::fromInt((int)$exifArray['FileType']) : FileType::undefined()
        );
    }

    public function getFileName(): FileName
    {
        return $this->fileName;
    }

    public function getFileDateTime(): FileDateTime
    {
        return $this->fileDateTime;
    }

    public function getLastModifiedDate(): LastModifiedDate
    {
        return $this->lastModifiedDate;
    }

    public function getTakenDate(): TakenDate
    {
        return $this->takenDate;
    }

    public function getFileSize(): FileSize
    {
        return $this->fileSize;
    }

    public function getFileType(): FileType
    {
        return $this->fileType;
    }
}