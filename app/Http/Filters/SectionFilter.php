<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Kodewbit\Meteor\Filter;

class SectionFilter extends Filter
{
    /**
     * Filter sections by title.
     *
     * @param string|null $title
     * @return Builder
     */
    public function title(string $title = null)
    {
        return $this->builder->where('title', 'LIKE', "%{$title}%");
    }

    /**
     * Filter sections by audio.
     *
     * @param string|null $audio
     * @return Builder
     */
    public function audio(string $audio = null)
    {
        return $this->builder->where('audio', 'LIKE', "%{$audio}%");
    }

    /**
     * Filter sections by duration.
     *
     * @param string|null $duration
     * @return Builder
     */
    public function duration(string $duration = null)
    {
        return $this->builder->where('duration', 'LIKE', "%{$duration}%");
    }

    /**
     * Filter sections by file type.
     *
     * @param string|null $fileType
     * @return Builder
     */
    public function fileType(string $fileType = null)
    {
        return $this->builder->where('file_type', 'LIKE', "%{$fileType}%");
    }
}
