<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BooksController extends Controller
{
    /**
     * Paginate Books model.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $resource = Book::with(['genres', 'authors', 'sections', 'translators']);

        return BookResource::collection($resource->simplePaginate());
    }

    /**
     * Show specific book details.
     *
     * @param Request $request
     * @param $id
     * @return BookResource
     */
    public function show(Request $request, $id)
    {
        $resource = Book::findOrFail($id)->loadMissing(['genres', 'authors', 'sections', 'translators']);

        return BookResource::make($resource);
    }
}
