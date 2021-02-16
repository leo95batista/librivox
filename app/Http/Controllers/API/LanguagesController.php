<?php

namespace App\Http\Controllers\API;

use App\Http\Filters\LanguageFilter;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LanguagesController extends ApiController
{
    /**
     * Paginate Languages model.
     *
     * @param Request $request
     * @param LanguageFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, LanguageFilter $filter)
    {
        $resource = Language::filter($filter)->simplePaginate();

        return LanguageResource::collection($resource);
    }

    /**
     * Show specific language details.
     *
     * @param Request $request
     * @param $id
     * @return LanguageResource
     */
    public function show(Request $request, $id)
    {
        $resource = Language::findOrFail($id);

        return LanguageResource::make($resource);
    }
}
