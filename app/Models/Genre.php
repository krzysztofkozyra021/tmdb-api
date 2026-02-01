<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property int $tmdb_id
 * @property string $type
 * @property string $name
 */
class Genre extends Model
{
    use HasTranslations;

    public $translatable = ["name"];
    protected $fillable = [
        "tmdb_id",
        "type",
        "name",
    ];
    protected $casts = [
        "tmdb_id" => "integer",
        "type" => "string",
    ];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class);
    }

    public function series(): BelongsToMany
    {
        return $this->belongsToMany(Serie::class);
    }
}
