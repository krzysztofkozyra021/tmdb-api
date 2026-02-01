<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\FetchTmdbDataJob;
use Illuminate\Console\Command;

class FetchTmdb extends Command
{
    protected $signature = "tmdb:fetch";
    protected $description = "Fetch data from TMDB";

    public function handle(): void
    {
        FetchTmdbDataJob::dispatch();
        $this->info("TMDB data fetched with success");
    }
}
