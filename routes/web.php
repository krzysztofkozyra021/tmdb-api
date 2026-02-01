<?php

declare(strict_types=1);

use App\Livewire\MovieList;
use Illuminate\Support\Facades\Route;

Route::get("/movies", MovieList::class);
