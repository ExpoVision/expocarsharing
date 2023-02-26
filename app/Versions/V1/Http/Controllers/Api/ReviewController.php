<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\DTO\ReviewDto;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Requests\ReviewStoreRequest;
use App\Versions\V1\Http\Resources\Collections\ReviewCollection;
use App\Versions\V1\Http\Resources\ReviewResource;
use App\Versions\V1\Repositories\ReviewRepository;
use App\Versions\V1\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(
        private ReviewRepository $repository,
        private ReviewService $service,
    ) {
    }

    public function index(Request $request): ReviewCollection
    {
        return new ReviewCollection($this->repository->paginate());
    }

    public function store(ReviewStoreRequest $request): ReviewResource
    {
        $review = $this->service->store(ReviewDto::fromRequest($request));

        return new ReviewResource($review);
    }
}
