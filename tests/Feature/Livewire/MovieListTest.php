<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Livewire\MovieList;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MovieListTest extends TestCase
{
    use RefreshDatabase;

    public function testRendersSuccessfully(): void
    {
        Livewire::test(MovieList::class)
            ->assertStatus(200);
    }

    public function testCanSeeMovies(): void
    {
        $movie = Movie::create([
            "tmdb_id" => 123,
            "title" => "Test Movie",
            "overview" => "Test Overview",
            "popularity" => 10,
            "vote_average" => 8.5,
            "vote_count" => 100,
        ]);

        Livewire::test(MovieList::class)
            ->assertSee("Test Movie");
    }
}
