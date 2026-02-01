<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SerieResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /**
         * @var Serie $serie
         */
        $serie = $this->resource;

        return [
            "tmdb_id" => $serie->tmdb_id,
            "poster_path" => $serie->poster_path,
            "name" => $serie->name, 
            "overview" => $serie->overview,
            "genre_ids" => $serie->genre_ids,
        ];
    }
}
