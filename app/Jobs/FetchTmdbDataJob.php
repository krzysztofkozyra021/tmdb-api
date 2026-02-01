<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\Tmdb\TmdbService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchTmdbDataJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private array $languages;

    public function __construct()
    {
        $this->languages = config("app.supported_locales", "en");
    }

    public function handle(TmdbService $tmdb): void
    {
        foreach ($this->languages as $appLang => $tmdbLang) {
            $tmdb->syncMovies($appLang);
            $tmdb->syncSeries($appLang);
            $tmdb->syncGenres($appLang);
        }
    }
}
