<?php

namespace App\Http\Controllers\API;

use App\Http\Filters\AuthorFilter;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthorsController extends ApiController
{
    /**
     * Paginate Authors model.
     *
     * @param Request $request
     * @param AuthorFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, AuthorFilter $filter)
    {
        $resource = Author::filter($filter)->simplePaginate();

        return AuthorResource::collection($resource);
    }

    /**
     * Show specific author details.
     *
     * @param Request $request
     * @param $id
     * @return AuthorResource
     */
    public function show(Request $request, $id)
    {
        $resource = Author::findOrFail($id);

        return AuthorResource::make($resource);
    }
}
