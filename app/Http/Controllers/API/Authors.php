<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class Authors extends Controller
{
    /**
     * Paginate the Authors model.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return AuthorResource::collection(Author::simplePaginate());
    }

    /**
     * Show specific author details.
     *
     * @param $id
     * @return AuthorResource
     */
    public function show($id)
    {
        return AuthorResource::make(Author::findOrFail($id));
    }
}
