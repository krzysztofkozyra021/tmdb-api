<?php

declare(strict_types=1);

namespace App\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TmdbServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(ClientInterface::class, fn(): Client => new Client([
            "base_uri" => config("services.tmdb.endpoint"),
            "timeout" => 5,
            "http_errors" => false,
        ]));
    }

    public function provides(): array
    {
        return [ClientInterface::class];
    }
}
