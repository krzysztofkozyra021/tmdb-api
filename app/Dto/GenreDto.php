<?php

declare(strict_types=1);

namespace App\Dto;

class GenreDto
{
    public function __construct(
        public ?int $id,
        public int $tmdbId,
        public string $type,
        public string $name,
    ) {}

    public static function fromArray(array $data, string $type = "movie"): self
    {
        return new self(
            id: $data["id"] ?? null,
            tmdbId: $data["id"],
            type: $type,
            name: $data["name"] ?? "",
        );
    }
}
