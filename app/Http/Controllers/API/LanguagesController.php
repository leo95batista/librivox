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
        return LanguageResource::collection(Language::simplePaginate());

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
        return LanguageResource::make(Language::findOrFail($id));
    }
}
