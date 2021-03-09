<?php

namespace App\Models;

use App\Scopes\ExcludeInactive;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kodewbit\Meteor\Filterable;

/**
 * Class Section
 *
 * @package App\Models
 * @mixin Builder
 */
class Section extends Model
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
        'title',
        'audio',
        'duration',
        'file_type',
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
     * Book relationship
     *
     * @return BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
