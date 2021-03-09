<?php

namespace App\Scopes;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ExcludeInactive implements Scope
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
        if ($model->is(new Book())) {
            $builder->whereHas('language')
                ->whereDoesntHave('genres', function (Builder $query) {
                    return $query->withoutGlobalScopes()->where('active', false);
                })
                ->whereDoesntHave('authors', function (Builder $query) {
                    return $query->withoutGlobalScopes()->where('active', false);
                });
        }

        $builder->where('active', true);
    }
}
