<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property int $tmdb_id
 * @property ?string $backdrop_path
 * @property ?string $poster_path
 * @property string $title
 * @property string $overview
 * @property ?string $original_title
 * @property ?string $original_language
 * @property ?array $genre_ids
 * @property Carbon|string $release_date
 * @property bool $adult
 * @property bool $video
 * @property float $popularity
 * @property float $vote_average
 * @property int $vote_count
 * @property-read Collection|array<Genre> $genres
 * @property-read int|null $genres_count
 */
class Movie extends Model
{
    use HasTranslations;

    public $translatable = [
        "title",
        "overview",
    ];
    protected $fillable = [
        "tmdb_id",
        "backdrop_path",
        "poster_path",
        "title",
        "overview",
        "original_title",
        "original_language",
        "genre_ids",
        "release_date",
        "adult",
        "video",
        "popularity",
        "vote_average",
        "vote_count",
    ];
    protected $casts = [
        "tmdb_id" => "integer",
        "genre_ids" => "array",
        "release_date" => "date",
        "adult" => "boolean",
        "video" => "boolean",
        "popularity" => "float",
        "vote_average" => "float",
        "vote_count" => "integer",
    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
