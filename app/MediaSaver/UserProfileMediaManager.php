<?php

namespace App\MediaSaver;

use App\Models\UserProfile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserProfileMediaManager extends MediaManager
{
    public function __construct(
        private UserProfile $model,
        public UploadedFile $file
    ) {
    }

    public function save(string $key): string
    {
        $this->deleteIfFilled($key);

        return $this->saveTo($this->file, $key, 'user-media');
    }

    public function deleteIfFilled(string $key)
    {
        $filePath = $this->model->$key;

        if ($filePath) {
            $this->delete($filePath);
        }
    }

    public function delete(string $path): bool
    {
        return Storage::disk('user-media')->delete($path);
    }
}
