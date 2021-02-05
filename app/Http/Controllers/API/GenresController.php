<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GenresController extends Controller
{
    /**
     * Paginate Genres model.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return GenreResource::collection(Genre::simplePaginate());
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
        return GenreResource::make(Genre::findOrFail($id));
    }
}
