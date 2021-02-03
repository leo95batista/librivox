<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Translator
 *
 * @package App\Models
 * @mixin Builder
 */
class Translator extends Model
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
     * Books relationship
     *
     * @return BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
