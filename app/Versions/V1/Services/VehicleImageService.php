<?php

namespace App\Versions\V1\Services;

use App\MediaSaver\VehicleMediaManager;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Versions\V1\DTO\VehicleImageDto;
use App\Versions\V1\Repositories\VehicleImageRepository;
use Illuminate\Http\UploadedFile;

class VehicleImageService
{
    private VehicleImageRepository $repository;

    public function __construct(
        private VehicleImage $image,
        private Vehicle $vehicle,
    ) {
        $image = $image ?: app(VehicleImage::class);

        $this->repository = app(VehicleImageRepository::class, compact('image'));
    }

    public function store(VehicleImageDto $dto): static
    {
        $this->repository
            ->fill($dto->toArray())
            ->save();

        return $this;
    }

    /**
     * @param array<UploadedFile> $images
     *
     * @return static
     */
    public function storeMedia(array $images): static
    {
        /** @var VehicleMediaManager $mediaManager */
        $mediaManager = app(VehicleMediaManager::class, compact('images'));

        $paths = $mediaManager->save();
        $dtos = [];

        foreach ($paths as $path) {
            $attr = ['path' => $path, 'vehicle_id' => $this->vehicle->id];
            $dtos[] = new VehicleImageDto($attr);
        }

        $this->batchStore($dtos);

        return $this;
    }

    /**
     * @param array<VehicleImageDto> $images
     */
    public function batchStore(array $images): static
    {
        foreach ($images as $image) {
            $this->repository = app(VehicleImageRepository::class);
            $this->store($image);
        }

        return $this;
    }
}
