<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Kodewbit\Meteor\Filter;

class AuthorFilter extends Filter
{
    /**
     * Filter authors by first name.
     *
     * @param string|null $firstName
     * @return Builder
     */
    public function firstName(string $firstName = null)
    {
        return $this->builder->where('first_name', 'LIKE', "%{$firstName}%");
    }

    /**
     * Filter authors by last name.
     *
     * @param string|null $lastName
     * @return Builder
     */
    public function lastName(string $lastName = null)
    {
        return $this->builder->where('last_name', 'LIKE', "%{$lastName}%");
    }

    /**
     * Filter authors by given day of birth.
     *
     * @param string|null $dob
     * @return Builder
     */
    public function dob(string $dob = null)
    {
        return $this->builder->where('dob', $dob);
    }

    /**
     * Filter authors by given day of death.
     *
     * @param string|null $dod
     * @return Builder
     */
    public function dod(string $dod = null)
    {
        return $this->builder->where('dod', $dod);
    }
}
