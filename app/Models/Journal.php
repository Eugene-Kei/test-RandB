<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

/**
 * Class Journal
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $published_at
 */
class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'published_at',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'image_url'
    ];

    protected $dates = ['published_at'];

    /**
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::disk('image')->url($this->image) : null;
    }

    /**
     * @return BelongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(
            Author::class,
            'authors_journals',
            'journal_id',
            'author_id',
        );
    }
}
