<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class LanguageFilter extends Filter
{
    /**
     * Filter languages by name.
     *
     * @param string|null $name
     * @return Builder
     */
    public function name(string $name = null)
    {
        return $this->builder->where('name', 'LIKE', "%{$name}%");
    }
}
