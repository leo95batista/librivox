<?php

namespace App\Http\Controllers\API;

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
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return TranslatorResource::collection(Translator::simplePaginate());
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
        return TranslatorResource::make(Translator::findOrFail($id));
    }
}
