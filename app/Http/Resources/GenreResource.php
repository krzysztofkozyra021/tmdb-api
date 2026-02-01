<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /**
         * @var Genre $genre
         */
        $genre = $this->resource;

        return [
            "name" => $genre->name,
            "type" => $genre->type,
        ];
    }
}
