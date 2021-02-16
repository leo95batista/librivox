<?php

namespace App\Http\Controllers\API;

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
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $resource = new Genre();

        if ($this->wantsExtendedInformation($request)) {
            $resource = $resource->with($resource->getRelations());
        }

        return GenreResource::collection($resource->simplePaginate());
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

        if ($this->wantsExtendedInformation($request)) {
            $resource = $resource->loadMissing($resource->getRelations());
        }

        return GenreResource::make($resource);
    }
}
