<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{
    use HasFactory;

    /**
     * Book relationship
     *
     * @return BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
