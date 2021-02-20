<?php

namespace App\Http\Controllers\API;

use App\Http\Filters\SectionFilter;
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
     * @param SectionFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, SectionFilter $filter)
    {
        $resource = Section::filter($filter)->simplePaginate();

        return SectionResource::collection($resource);
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
        $resource = Section::findOrFail($id);

        return SectionResource::make($resource);
    }
}
