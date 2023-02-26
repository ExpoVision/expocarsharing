<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Models\Feedback;
use App\Versions\V1\DTO\FeedbackDto;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Requests\FeedbackStoreRequest;
use App\Versions\V1\Http\Resources\Collections\FeedbackCollection;
use App\Versions\V1\Http\Resources\FeedbackResource;
use App\Versions\V1\Repositories\FeedbackRepository;
use App\Versions\V1\Services\FeedbackService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function archival(Request $request): FeedbackCollection
    {
        return new FeedbackCollection($this->repository->onlyTrashed());
    }

    public function store(FeedbackStoreRequest $request): FeedbackResource
    {
        $feedback = app(FeedbackService::class)
            ->store(FeedbackDto::fromRequest($request));

        return new FeedbackResource($feedback);
    }

    public function destroy(Request $request, Feedback $feedback): Response
    {
        $feedback = app(FeedbackService::class, compact('feedback'))
            ->delete();

        return response('', Response::HTTP_NO_CONTENT);
    }
}
