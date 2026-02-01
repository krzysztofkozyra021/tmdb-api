<?php

declare(strict_types=1);

use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\SeriesController;
use Illuminate\Support\Facades\Route;

Route::get("/movies", [MovieController::class, "index"]);
Route::get("/series", [SeriesController::class, "index"]);
Route::get("/genres", [GenreController::class, "index"]);
