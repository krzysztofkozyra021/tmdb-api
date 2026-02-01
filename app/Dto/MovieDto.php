<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Carbon;

class MovieDto
{
    public function __construct(
        public ?int $id,
        public int $tmdbId,
        public ?string $backdropPath,
        public ?string $posterPath,
        public string $title,
        public string $overview,
        public ?string $originalTitle,
        public ?string $originalLanguage,
        public ?array $genreIds,
        public Carbon|string $releaseDate,
        public bool $adult,
        public bool $video,
        public float $popularity,
        public float $voteAverage,
        public int $voteCount,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data["id"] ?? null,
            tmdbId: $data["id"],
            backdropPath: $data["backdrop_path"] ?? null,
            posterPath: $data["poster_path"] ?? null,
            title: $data["title"] ?? "",
            overview: $data["overview"] ?? "",
            originalTitle: $data["original_title"] ?? null,
            originalLanguage: $data["original_language"] ?? null,
            genreIds: $data["genre_ids"] ?? [],
            releaseDate: isset($data["release_date"]) ? Carbon::parse($data["release_date"]) : Carbon::now(),
            adult: (bool)($data["adult"] ?? false),
            video: (bool)($data["video"] ?? false),
            popularity: (float)($data["popularity"] ?? 0),
            voteAverage: (float)($data["vote_average"] ?? 0),
            voteCount: (int)($data["vote_count"] ?? 0),
        );
    }
}
