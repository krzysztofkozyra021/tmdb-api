<?php

declare(strict_types=1);

namespace App\Services\Tmdb;

final class TmdbLocaleResolver
{
    public function default(string $appLang): string
    {
        return config("app.supported_locales.$appLang");
    }

    public function genre(string $appLang): string
    {
        $fullLocale = config("app.supported_locales.$appLang");

        return explode("-", $fullLocale)[0];
    }
}
