<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\Http\Resources\Collections\OfferCollection;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Repositories\OfferRepository;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct(
        public OfferRepository $repository
    ) {
    }

    public function index(Request $request): OfferCollection
    {
        $this->repository->builder->filterBy($request->all());

        return new OfferCollection($this->repository->paginate());
    }
}
