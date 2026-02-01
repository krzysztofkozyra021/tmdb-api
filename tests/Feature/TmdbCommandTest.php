<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Jobs\FetchTmdbDataJob;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class TmdbCommandTest extends TestCase
{
    public function testCommandDispatchesJobToQueue(): void
    {
        Queue::fake();

        $this->artisan("tmdb:fetch")
            ->assertExitCode(0);

        Queue::assertPushed(FetchTmdbDataJob::class);
    }
}
