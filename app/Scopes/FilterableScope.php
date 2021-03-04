<?php

namespace App\Scopes;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

trait FilterableScope
{
    /**
     * Apply all relevant filters.
     *
     * @param Builder $builder
     * @param Filter $filter
     * @return Builder
     */
    public function scopeFilter(Builder $builder, Filter $filter)
    {
        return $filter->apply($builder);
    }
}
