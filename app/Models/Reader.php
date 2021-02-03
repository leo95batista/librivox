<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Reader
 *
 * @package App\Models
 * @mixin Builder
 */
class Reader extends Model
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
        'display_name'
    ];

    /**
     * Sections relationship
     *
     * @return BelongsToMany
     */
    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }
}
