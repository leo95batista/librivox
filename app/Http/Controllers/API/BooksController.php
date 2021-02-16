<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BooksController extends ApiController
{
    /**
     * Paginate Books model.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $resource = new Book();

        if ($this->wantsExtendedInformation($request)) {
            $resource = $resource->with($resource->getRelations());
        }

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
        $resource = Book::findOrFail($id);

        if ($this->wantsExtendedInformation($request)) {
            $resource = $resource->loadMissing($resource->getRelations());
        }

        return BookResource::make($resource);
    }

    /**
     * Get the books associated with a certain language.
     *
     * @param Request $request
     * @param $id
     * @return AnonymousResourceCollection
     */
    public function language(Request $request, $id)
    {
        $resource = Book::where('language_id', $id);

        return BookResource::collection($resource->simplePaginate());
    }
}
