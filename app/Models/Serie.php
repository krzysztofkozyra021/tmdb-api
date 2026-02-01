<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property int $tmdb_id
 * @property ?string $backdrop_path
 * @property ?string $poster_path
 * @property string $name
 * @property string $overview
 * @property ?array $genre_ids
 * @property ?array $origin_country
 * @property ?string $original_name
 * @property string $original_language
 * @property Carbon $first_air_date
 * @property float $popularity
 * @property float $vote_average
 * @property int $vote_count
 */
class Serie extends Model
{
    use HasTranslations;

    public $translatable = [
        "name",
        "overview",
    ];
    protected $fillable = [
        "tmdb_id",
        "backdrop_path",
        "poster_path",
        "name",
        "overview",
        "genre_ids",
        "origin_country",
        "original_name",
        "original_language",
        "first_air_date",
        "popularity",
        "vote_average",
        "vote_count",
    ];
    protected $casts = [
        "tmdb_id" => "integer",
        "genre_ids" => "array",
        "origin_country" => "array",
        "first_air_date" => "date",
        "popularity" => "float",
        "vote_average" => "float",
        "vote_count" => "integer",
    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
