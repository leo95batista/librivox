<?php

namespace App\Http\Controllers\API;

use App\Http\Filters\BookFilter;
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
     * @param BookFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, BookFilter $filter)
    {
        $resource = Book::filter($filter);

        if ($this->wantsExtendedInformation($request)) {
            $resource = $resource->with($resource->getModel()->getRelations());
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
     * Get the books associated with a certain author.
     *
     * @param Request $request
     * @param $id
     * @return AnonymousResourceCollection
     */
    public function author(Request $request, $id)
    {
        $resource = Book::whereHas('authors', function ($query) use ($id) {
            return $query->where('author_id', $id);
        });

        return BookResource::collection($resource->simplePaginate());
    }

    /**
     * Get the books associated with a certain genre.
     *
     * @param Request $request
     * @param $id
     * @return AnonymousResourceCollection
     */
    public function genre(Request $request, $id)
    {
        $resource = Book::whereHas('genres', function ($query) use ($id) {
            return $query->where('genre_id', $id);
        });

        return BookResource::collection($resource->simplePaginate());
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

    /**
     * Get the books associated with a certain translator.
     *
     * @param Request $request
     * @param $id
     * @return AnonymousResourceCollection
     */
    public function translator(Request $request, $id)
    {
        $resource = Book::whereHas('translators', function ($query) use ($id) {
            return $query->where('translator_id', $id);
        });

        return BookResource::collection($resource->simplePaginate());
    }
}
