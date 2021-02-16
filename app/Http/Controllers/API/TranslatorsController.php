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
        $resource = new Translator();

        if ($this->wantsExtendedInformation($request)) {
            $resource = $resource->with($resource->getRelations());
        }

        return TranslatorResource::collection($resource->simplePaginate());
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

        if ($this->wantsExtendedInformation($request)) {
            $resource = $resource->loadMissing($resource->getRelations());
        }

        return TranslatorResource::make($resource);
    }
}
