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
            'year' => $this->copyright_year,
            'title' => $this->title,
            'image' => $this->thumbnail,
            'language' => $this->language,
            'description' => $this->description,
            'time' => $this->totaltime,
            'genres' => GenreResource::collection($this->whenLoaded('genres')),
            'authors' => AuthorResource::collection($this->whenLoaded('authors')),
            'translators' => TranslatorResource::collection($this->whenLoaded('translators')),
            'sections' => SectionResource::collection($this->whenLoaded('sections'))
        ];
    }
}
