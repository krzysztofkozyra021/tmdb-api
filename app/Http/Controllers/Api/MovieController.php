<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        return MovieResource::collection(Movie::paginate(10));
    }
}
