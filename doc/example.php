<?php

use ExifReader\CannotReadExifData;
use ExifReader\Reader;

$exifReader = new Reader();

try {
    $exifData = $exifReader->read(__DIR__ . '/../tests/images/with-coordinates.jpg');
} catch (CannotReadExifData $e) {
    echo 'Cannot read exif data: ' . $e->getMessage();
}

echo $exifData->getCameraData()->getMaker();        // Sony
echo $exifData->getCameraData()->getModel();        // F5121
echo $exifData->getFileData()->getTakenDate();      // 2017-06-09 18:43:32
echo $exifData->getGeoLocation()->getLatitude();    // 64.25784
echo $exifData->getGeoLocation()->getLongitude();   // -21.121168
