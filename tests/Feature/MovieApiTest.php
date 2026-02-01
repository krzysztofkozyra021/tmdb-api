<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieApiTest extends TestCase
{
    use RefreshDatabase;

    public function testApiReturnsMoviesListSuccessfully(): void
    {
        Movie::create([
            "tmdb_id" => 1001,
            "title" => ["en" => "Test Movie"],
            "overview" => ["en" => "Test Overview"],
        ]);

        $response = $this->getJson("/api/movies");

        $response->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    "*" => ["tmdb_id", "title", "overview"],
                ],
                "meta" => ["current_page", "total"],
            ]);
    }

    public function testApiReturnsCorrectLanguageBasedOnHeader(): void
    {
        Movie::create([
            "tmdb_id" => 12345,
            "title" => [
                "pl" => "Polski Tytuł",
                "en" => "English Title",
            ],
            "overview" => ["pl" => "Opis", "en" => "Desc"],
        ]);

        $responsePl = $this->getJson("/api/movies", ["Accept-Language" => "pl"]);

        $responsePl->assertStatus(200)
            ->assertJsonFragment(["title" => "Polski Tytuł"])
            ->assertJsonMissing(["title" => "English Title"]);

        $responseEn = $this->getJson("/api/movies", ["Accept-Language" => "en"]);

        $responseEn->assertStatus(200)
            ->assertJsonFragment(["title" => "English Title"])
            ->assertJsonMissing(["title" => "Polski Tytuł"]);
    }

    public function testApiPaginatesResults(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Movie::create([
                "tmdb_id" => $i,
                "title" => ["en" => "Movie $i"],
                "overview" => ["en" => "Desc $i"],
            ]);
        }

        Movie::create([
            "tmdb_id" => 16,
            "title" => ["en" => "Test Movie"],
            "overview" => ["en" => "Test Overview"],
        ]);

        $response = $this->getJson("/api/movies");
        $response->assertStatus(200)
            ->assertJsonCount(10, "data")
            ->assertJsonPath("meta.total", 16);

        $responsePage2 = $this->getJson("/api/movies?page=2");
        $responsePage2->assertStatus(200)
            ->assertJsonCount(6, "data")
            ->assertJsonPath("meta.current_page", 2);

        $responsePage2->assertJsonFragment([
            "title" => "Test Movie",
        ]);
    }
}
