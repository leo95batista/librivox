<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Kodewbit\Meteor\Filter;

class BookFilter extends Filter
{
    /**
     * Filter books by title.
     *
     * @param string|null $title
     * @return Builder
     */
    public function title(string $title = null)
    {
        return $this->builder->where('title', 'LIKE', "%{$title}%");
    }

    /**
     * Filter books by description.
     *
     * @param string|null $description
     * @return Builder
     */
    public function description(string $description = null)
    {
        return $this->builder->where('description', 'LIKE', "%{$description}%");
    }

    /**
     * Filter books by copyright year.
     *
     * @param string|null $year
     * @return Builder
     */
    public function year(string $year = null)
    {
        return $this->builder->where('copyright_year', 'LIKE', "%{$year}%");
    }

    /**
     * Filter books by duration time.
     *
     * @param string|null $time
     * @return Builder
     */
    public function time(string $time = null)
    {
        return $this->builder->where('totaltime', 'LIKE', "%{$time}%");
    }
}
