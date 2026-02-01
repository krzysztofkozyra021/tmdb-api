<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("movies", function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger("tmdb_id")->unique()->index();
            $table->string("backdrop_path")->nullable();
            $table->string("poster_path")->nullable();
            $table->jsonb("title");
            $table->jsonb("overview");
            $table->string("original_title")->nullable();
            $table->string("original_language", 10)->nullable();
            $table->jsonb("genre_ids")->nullable();
            $table->date("release_date")->nullable();
            $table->boolean("adult")->default(true);
            $table->boolean("video")->default(true);
            $table->float("popularity")->default(0);
            $table->float("vote_average")->default(0);
            $table->integer("vote_count")->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("movies");
    }
};
