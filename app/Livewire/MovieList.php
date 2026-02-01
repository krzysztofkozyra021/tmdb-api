<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Movie;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class MovieList extends Component
{
    use WithPagination;

    public function render(): View
    {
        return view("livewire.movie-list", [
            "movies" => Movie::paginate(20),
        ]);
    }
}
