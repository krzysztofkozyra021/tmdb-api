<?php

declare(strict_types=1);

namespace App\Actions;

use App\Dto\MovieDto;
use App\Models\Genre;
use App\Models\Movie;
use Carbon\Carbon;

class SyncMovieAction
{
    public function execute(MovieDto $movieDto, string $lang): Movie
    {
        $movie = Movie::firstOrNew(["tmdb_id" => $movieDto->tmdbId]);

        $movie->fill([
            "poster_path" => $movieDto->posterPath,
            "backdrop_path" => $movieDto->backdropPath,
            "original_title" => $movieDto->originalTitle,
            "original_language" => $movieDto->originalLanguage,
            "release_date" => $movieDto->releaseDate instanceof Carbon
                ? $movieDto->releaseDate->toDateString()
                : $movieDto->releaseDate,
            "adult" => $movieDto->adult,
            "video" => $movieDto->video,
            "popularity" => $movieDto->popularity,
            "vote_average" => $movieDto->voteAverage,
            "vote_count" => $movieDto->voteCount,
            "genre_ids" => $movieDto->genreIds,
        ]);

        $movie->setTranslation("title", $lang, $movieDto->title ?? "Untitled");
        $movie->setTranslation("overview", $lang, $movieDto->overview ?? "");

        $movie->save();

        $genreTmdbIds = is_array($movieDto->genreIds) ? $movieDto->genreIds : [];
        $genreIds = Genre::query()
            ->whereIn("tmdb_id", $genreTmdbIds)
            ->pluck("id")
            ->all();

        $movie->genres()->sync($genreIds);

        return $movie;
    }
}
