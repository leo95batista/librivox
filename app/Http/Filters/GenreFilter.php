<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Kodewbit\Meteor\Filter;

class GenreFilter extends Filter
{
    /**
     * Filter genres by name.
     *
     * @param string|null $name
     * @return Builder
     */
    public function name(string $name = null)
    {
        return $this->builder->where('name', 'LIKE', "%{$name}%");
    }
}
