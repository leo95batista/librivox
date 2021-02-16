<?php

namespace App\Http\Controllers\API;

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
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $resource = new Language();

        return LanguageResource::collection($resource->simplePaginate());
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
