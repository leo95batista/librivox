<?php

namespace App\Http\Controllers\API;

use App\Http\Filters\GenreFilter;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GenresController extends ApiController
{
    /**
     * Paginate Genres model.
     *
     * @param Request $request
     * @param GenreFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, GenreFilter $filter)
    {
        $resource = Genre::filter($filter)->simplePaginate();

        return GenreResource::collection($resource);
    }

    /**
     * Show specific genre details.
     *
     * @param Request $request
     * @param $id
     * @return GenreResource
     */
    public function show(Request $request, $id)
    {
        $resource = Genre::findOrFail($id);

        return GenreResource::make($resource);
    }
}
