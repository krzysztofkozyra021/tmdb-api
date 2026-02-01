<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("genre_serie", function (Blueprint $table): void {
            $table->id();
            $table->foreignId("serie_id")->constrained()->cascadeOnDelete();
            $table->foreignId("genre_id")->constrained()->cascadeOnDelete();
            $table->unique(["serie_id", "genre_id"]);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("genre_serie");
    }
};
