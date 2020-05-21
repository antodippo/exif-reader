<?php
declare(strict_types=1);

namespace ExifReader;

class Reader
{
    /**
     * @throws CannotReadExifData
     */
    public function read(string $filename): ExifData
    {
        try {
            $exifDataArray = @exif_read_data($filename);
        } catch (\Exception $e) {
            throw new CannotReadExifData($e->getMessage());
        }

        if (! is_array($exifDataArray)) {
            throw new CannotReadExifData();
        }

        return ExifData::fromExifArray($exifDataArray);
    }
}
