<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /**
         * @var Movie $movie
         */
        $movie = $this->resource;

        return [
            "tmdb_id" => $movie->tmdb_id,
            "poster_path" => $movie->poster_path,
            "title" => $movie->title, 
            "overview" => $movie->overview,
            "genre_ids" => $movie->genre_ids,
        ];
    }
}
