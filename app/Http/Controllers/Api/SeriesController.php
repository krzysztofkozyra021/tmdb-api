<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SerieResource;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index()
    {
        return SerieResource::collection(Serie::paginate(10));
    }
}
