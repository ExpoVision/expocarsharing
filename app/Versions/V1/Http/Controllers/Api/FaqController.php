<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\Collections\FaqCollection;
use App\Versions\V1\Repositories\FaqRepository;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct(
        public FaqRepository $repository
    ) {
    }

    public function index(Request $request): FaqCollection
    {
        return new FaqCollection($this->repository->paginate(5));
    }
}
