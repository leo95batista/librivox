<?php

namespace App\Http\Controllers\API;

use App\Http\Filters\TranslatorFilter;
use App\Http\Resources\TranslatorResource;
use App\Models\Translator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TranslatorsController extends ApiController
{
    /**
     * Paginate Translators model.
     *
     * @param Request $request
     * @param TranslatorFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, TranslatorFilter $filter)
    {
        $resource = Translator::filter($filter)->simplePaginate();

        return TranslatorResource::collection($resource);
    }

    /**
     * Show specific translator details.
     *
     * @param Request $request
     * @param $id
     * @return TranslatorResource
     */
    public function show(Request $request, $id)
    {
        $resource = Translator::findOrFail($id);

        return TranslatorResource::make($resource);
    }
}
