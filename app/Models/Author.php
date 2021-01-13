<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
    ];

    /**
     * @return BelongsToMany
     */
    public function journals()
    {
        return $this->belongsToMany(
            Journal::class,
            'authors_journals',
            'author_id',
            'journal_id',
        );
    }
}
