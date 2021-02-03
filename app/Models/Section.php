<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Section
 *
 * @package App\Models
 * @mixin Builder
 */
class Section extends Model
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
        'section_number',
        'title',
        'listen_url',
        'language',
        'playtime',
        'filename'
    ];

    /**
     * Book relationship
     *
     * @return BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Readers relationship
     *
     * @return BelongsToMany
     */
    public function readers()
    {
        return $this->belongsToMany(Reader::class);
    }
}
