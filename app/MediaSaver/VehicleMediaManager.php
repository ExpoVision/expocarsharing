<?php

namespace App\MediaSaver;

use Illuminate\Http\UploadedFile;

class VehicleMediaManager extends MediaManagerContract
{
    public const MEDIA_FOLDER = 'vehicles';

    /**
     * @param array<UploadedFile> $images
     */
    public function __construct(
        protected array $images,
    ) {
    }

    public function save()
    {
        return $this->batchSave();
    }

    /**
     * @return array<string>
     */
    public function batchSave(): array
    {
        $paths = [];

        foreach ($this->images as $image)
        {
            $paths[] = $this->saveTo($image, self::MEDIA_FOLDER, 'public');
        }

        return $paths;
    }
}
