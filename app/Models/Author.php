<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     *
     * @var string[]
     */
    protected $fillable = ['first_name', 'last_name', 'dob', 'dod'];
}
