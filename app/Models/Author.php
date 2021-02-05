<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * Class Author
 *
 * @package App\Models
 * @mixin Builder
 */
class Author extends Model
{
    use HasFactory;

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
        'first_name',
        'last_name',
        'dob',
        'dod'
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
     * Books relationship
     *
     * @return BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    /**
     * Get author full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return Str::title("{$this->first_name} {$this->last_name}");
    }
}
