<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SectionsController extends ApiController
{
    /**
     * Paginate Sections model.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return SectionResource::collection(Section::simplePaginate());
    }

    /**
     * Show specific translator details.
     *
     * @param Request $request
     * @param $id
     * @return SectionResource
     */
    public function show(Request $request, $id)
    {
        return SectionResource::make(Section::findOrFail($id));
    }
}
