<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Carbon;

class SerieDto
{
    public function __construct(
        public ?int $id,
        public int $tmdbId,
        public ?string $backdropPath,
        public ?string $posterPath,
        public string $name,
        public string $overview,
        public ?array $genreIds,
        public ?array $originCountry,
        public ?string $originalName,
        public string $originalLanguage,
        public Carbon|string $firstAirDate,
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
            name: $data["name"] ?? "",
            overview: $data["overview"] ?? "",
            genreIds: $data["genre_ids"] ?? [],
            originCountry: $data["origin_country"] ?? [],
            originalName: $data["original_name"] ?? null,
            originalLanguage: $data["original_language"] ?? "",
            firstAirDate: isset($data["first_air_date"]) ? Carbon::parse($data["first_air_date"]) : Carbon::now(),
            popularity: (float)($data["popularity"] ?? 0),
            voteAverage: (float)($data["vote_average"] ?? 0),
            voteCount: (int)($data["vote_count"] ?? 0),
        );
    }
}
