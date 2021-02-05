<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthorsController extends Controller
{
    /**
     * Paginate Authors model.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return AuthorResource::collection(Author::simplePaginate());
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
        return AuthorResource::make(Author::findOrFail($id));
    }
}
