<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("genres", function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger("tmdb_id")->index();
            $table->string("type")->index(); 
            $table->jsonb("name");
            $table->timestamps();
            $table->unique(["tmdb_id", "type"]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("genres");
    }
};
