<?php

namespace App\Models;

use App\Scopes\ExcludeBookWhenInactiveRelation;
use App\Scopes\ExcludeInactive;
use App\Scopes\FilterableScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    use HasFactory, FilterableScope;

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
        'active'
    ];

    /**
     * @inheritdoc
     *
     * @var array[]
     */
    protected $relations = [
        'authors',
        'genres',
        'language',
        'sections',
        'translators',
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
        static::addGlobalScope(new ExcludeBookWhenInactiveRelation());
    }

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
     * Language Relationship
     *
     * @return BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
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
     * Translators relationship
     *
     * @return BelongsToMany
     */
    public function translators()
    {
        return $this->belongsToMany(Translator::class);
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
