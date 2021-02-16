<?php

namespace App\Http\Controllers\API;

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
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $resource = new Author();

        return AuthorResource::collection($resource->simplePaginate());
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
