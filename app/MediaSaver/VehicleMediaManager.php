<?php

namespace App\MediaSaver;

use Illuminate\Http\UploadedFile;

class VehicleMediaManager extends MediaManagerContract
{
    public const MEDIA_FOLDER = 'vehicle';

    /**
     * @param array<UploadedFile> $images
     */
    public function __construct(
        protected array $images
    ) {
    }

    public function save()
    {
        return $this->batchSave();
    }

    public function batchSave()
    {
        $paths = [];

        foreach ($this->images as $image)
        {
            $paths[] = $this->saveTo($image, self::MEDIA_FOLDER, []);
        }

        return $paths;
    }
}
