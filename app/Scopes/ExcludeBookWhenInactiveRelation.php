<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ExcludeBookWhenInactiveRelation implements Scope
{
    /**
     * @inheritdoc
     *
     * @param Builder $builder
     * @param Model $model
     * @return Builder|void
     */
    public function apply(Builder $builder, Model $model)
    {
        return $builder
            ->whereHas('language')
            ->whereDoesntHave('genres', function (Builder $query) {
                return $query->withoutGlobalScopes()->where('active', false);
            })
            ->whereDoesntHave('authors', function (Builder $query) {
                return $query->withoutGlobalScopes()->where('active', false);
            });
    }
}
