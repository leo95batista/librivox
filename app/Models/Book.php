<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Class Book
 *
 * @package App\Models
 * @mixin Builder
 */
class Book extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     *
     * @var string[]
     */
    protected $guarded = [
        'id',
    ];

    /**
     * @inheritdoc
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'language',
        'description',
        'url_text_source',
        'copyright_year',
        'num_sections',
        'url_rss',
        'url_zip_file',
        'url_project',
        'url_librivox',
        'url_other',
        'totaltime',
        'totaltimesecs',
        'url_iarchive',
        'thumbnail',
    ];

    /**
     * @inheritdoc
     *
     * @var array[]
     */
    protected $relations = [
        'authors',
        'genres',
        'translators',
        'sections'
    ];

    /**
     * Authors relationship
     *
     * @return BelongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * Genders relationship
     *
     * @return BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * Translators relationship
     *
     * @return BelongsToMany
     */
    public function translators()
    {
        return $this->belongsToMany(Translator::class);
    }

    /**
     * Sections relationship
     *
     * @return HasMany
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    /**
     * Get the project identifier within the Internet Archive
     *
     * @return string
     */
    public function getInternetArchiveIdentifierAttribute()
    {
        return Str::afterLast($this->url_iarchive, '/');
    }
}
