<?php

namespace App\Models;

use App\Scopes\ExcludeInactive;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Kodewbit\Meteor\Filterable;

/**
 * Class Genre
 *
 * @package App\Models
 * @mixin Builder
 */
class Genre extends Model
{
    use HasFactory, Filterable;

    /**
     * @inheritdoc
     *
     * @var string[]
     */
    protected $guarded = [
        'id'
    ];

    /**
     * @inheritdoc
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'active'
    ];

    /**
     * @inheritdoc
     *
     * @var array[]
     */
    protected $relations = [
        'books',
    ];

    /**
     * @inheritdoc
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ExcludeInactive());
    }

    /**
     * Books relationship
     *
     * @return BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
