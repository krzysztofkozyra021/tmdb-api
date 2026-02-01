<?php

declare(strict_types=1);

namespace App\Actions;

use App\Dto\GenreDto;
use App\Models\Genre;

class SyncGenreAction
{
    public function execute(GenreDto $genreDto, string $lang): Genre
    {
        $genre = Genre::firstOrNew([
            "tmdb_id" => $genreDto->tmdbId,
            "type" => $genreDto->type,
        ]);

        $genre->fill([
            "type" => $genreDto->type,
        ]);

        $genre->setTranslation("name", $lang, $genreDto->name ?? "Untitled");

        $genre->save();

        return $genre;
    }
}
