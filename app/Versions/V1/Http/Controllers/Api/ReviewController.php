<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\Collections\ReviewCollection;
use App\Versions\V1\Repositories\ReviewRepository;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(
        public ReviewRepository $repository
    ) {
    }

    public function index(Request $request): ReviewCollection
    {
        return new ReviewCollection($this->repository->paginate());
    }
}
