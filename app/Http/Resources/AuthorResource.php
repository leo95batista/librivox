<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'dob' => $this->dob,
            'dod' => $this->dod,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'books' => BookResource::collection($this->whenLoaded('books'))
        ];
    }
}
