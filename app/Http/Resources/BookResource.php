<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->thumbnail,
            'language' => $this->language->name,
            'description' => $this->description,
            'year' => $this->copyright_year,
            'time' => $this->totaltime,
            'genres' => GenreResource::collection($this->genres),
            'authors' => AuthorResource::collection($this->authors),
            'translators' => TranslatorResource::collection($this->whenLoaded('translators')),
            'sections' => SectionResource::collection($this->whenLoaded('sections')),
        ];
    }
}
