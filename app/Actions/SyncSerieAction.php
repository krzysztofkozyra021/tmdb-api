<?php

declare(strict_types=1);

namespace App\Actions;

use App\Dto\SerieDto;
use App\Models\Genre;
use App\Models\Serie;
use Illuminate\Support\Carbon;

class SyncSerieAction
{
    public function execute(SerieDto $serieDto, string $lang): Serie
    {
        $serie = Serie::firstOrNew(["tmdb_id" => $serieDto->tmdbId]);

        $serie->fill([
            "poster_path" => $serieDto->posterPath,
            "backdrop_path" => $serieDto->backdropPath,
            "original_name" => $serieDto->originalName,
            "original_language" => $serieDto->originalLanguage,
            "origin_country" => $serieDto->originCountry,
            "first_air_date" => $serieDto->firstAirDate instanceof Carbon
                ? $serieDto->firstAirDate->toDateString()
                : $serieDto->firstAirDate,
            "popularity" => $serieDto->popularity,
            "vote_average" => $serieDto->voteAverage,
            "vote_count" => $serieDto->voteCount,
            "genre_ids" => $serieDto->genreIds,
        ]);

        $serie->setTranslation("name", $lang, $serieDto->name ?? "Untitled");
        $serie->setTranslation("overview", $lang, $serieDto->overview ?? "");

        $serie->save();

        $genreTmdbIds = is_array($serieDto->genreIds) ? $serieDto->genreIds : [];
        $genreIds = Genre::query()
            ->whereIn("tmdb_id", $genreTmdbIds)
            ->pluck("id")
            ->all();

        $serie->genres()->sync($genreIds);

        return $serie;
    }
}
