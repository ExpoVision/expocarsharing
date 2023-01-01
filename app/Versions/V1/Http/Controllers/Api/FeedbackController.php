<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\DTO\FeedbackDto;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Requests\FeedbackStoreRequest;
use App\Versions\V1\Http\Resources\Collections\FeedbackCollection;
use App\Versions\V1\Http\Resources\FeedbackResource;
use App\Versions\V1\Repositories\FeedbackRepository;
use App\Versions\V1\Services\FeedbackService;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function __construct(
        public FeedbackRepository $repository
    ) {
    }

    public function index(Request $request): FeedbackCollection
    {
        return new FeedbackCollection($this->repository->paginate(4));
    }

    public function store(FeedbackStoreRequest $request): FeedbackResource
    {
        $feedback = app(FeedbackService::class)
            ->store(FeedbackDto::fromRequest($request));

        return new FeedbackResource($feedback);
    }
}
