<?php

declare(strict_types=1);

namespace App\Services\Tmdb;

use App\Actions\SyncGenreAction;
use App\Actions\SyncMovieAction;
use App\Actions\SyncSerieAction;
use App\Dto\GenreDto;
use App\Dto\MovieDto;
use App\Dto\SerieDto;
use App\Exceptions\FetchException;
use GuzzleHttp\ClientInterface;

class TmdbService
{
    public function __construct(
        protected ClientInterface $client,
        protected SyncMovieAction $movieAction,
        protected SyncSerieAction $serieAction,
        protected SyncGenreAction $genreAction,
        protected TmdbLocaleResolver $localeResolver,
    ) {}

    public function getMovies(string $lang, int $page = 1): array
    {
        return $this->fetch("movie/popular", ["language" => $lang, "page" => $page]);
    }

    public function getSeries(string $lang, int $page = 1): array
    {
        return $this->fetch("tv/popular", ["language" => $lang, "page" => $page]);
    }

    public function getMovieGenres(string $lang): array
    {
        return $this->fetch("genre/movie/list", ["language" => $lang]);
    }

    public function getTvGenres(string $lang): array
    {
        return $this->fetch("genre/tv/list", ["language" => $lang]);
    }

    public function syncMovies(string $lang): void
    {
        $tmdbLang = $this->localeResolver->default($lang);

        $count = 0;
        $page = 1;
        $movieLimit = config("services.tmdb.movie_limit");

        while ($count < $movieLimit) {
            $data = $this->getMovies($tmdbLang, $page);

            if (empty($data["results"])) {
                break;
            }

            foreach ($data["results"] as $item) {
                if ($count >= $movieLimit) {
                    break;
                }

                $movieDto = MovieDto::fromArray($item);
                $this->movieAction->execute($movieDto, $lang);

                $count++;
            }
            $page++;
        }
    }

    public function syncSeries(string $lang): void
    {
        $tmdbLang = $this->localeResolver->default($lang);

        $count = 0;
        $page = 1;
        $serieLimit = config("services.tmdb.serie_limit");

        while ($count < $serieLimit) {
            $data = $this->getSeries($tmdbLang, $page);

            if (empty($data["results"])) {
                break;
            }

            foreach ($data["results"] as $item) {
                if ($count >= $serieLimit) {
                    break;
                }

                $serieDto = SerieDto::fromArray($item);
                $this->serieAction->execute($serieDto, $lang);

                $count++;
            }
            $page++;
        }
    }

    public function syncGenres(string $lang): void
    {
        $tmdbLang = $this->localeResolver->genre($lang);

        $movieGenres = $this->getMovieGenres($tmdbLang);

        foreach ($movieGenres["genres"] ?? [] as $item) {
            $genreDto = GenreDto::fromArray($item, "movie");

            $this->genreAction->execute($genreDto, $lang);
        }

        $tvGenres = $this->getTvGenres($tmdbLang);

        foreach ($tvGenres["genres"] ?? [] as $item) {
            $genreDto = GenreDto::fromArray($item, "serie");

            $this->genreAction->execute($genreDto, $lang);
        }
    }

    private function fetch(string $endpoint, array $params = []): array
    {
        $response = $this->client->request("GET", $endpoint, [
            "query" => array_merge($params, [
                "api_key" => config("services.tmdb.key"),
            ]),
        ]);

        $status = $response->getStatusCode();

        if ($status !== 200) {
            throw new FetchException();
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
