<?php

namespace App\MediaSaver;

use App\Models\UserProfile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserProfileMediaManager extends MediaManagerContract
{
    public function __construct(
        private UserProfile $model,
        public UploadedFile $file,
        public string $key,
    ) {
    }

    public function save(): string
    {
        $this->deleteIfFilled($this->key);

        return $this->saveTo($this->file, $this->key, 'user-media');
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
