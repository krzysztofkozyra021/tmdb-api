<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($movies as $movie)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col h-full">
                @if ($movie->poster_path)
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="{{ $movie->title }}" class="w-full h-96 object-fit">
                @else
                    <div class="w-full h-96 bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif
                <div class="p-4 flex-grow flex flex-col">
                    @if ($movie->title)
                        <h3 class="text-xl font-semibold mb-2">{{ $movie->title }}</h3>
                    @else
                        <h3 class="text-xl font-semibold mb-2">No title available</h3>
                    @endif
                    <h4 class="text-lg font-semibold mb-2 text-indigo-600">{{ $movie->type }}</h4>
                    @if ($movie->overview)
                        <p class="text-gray-600 text-sm h-32 overflow-y-auto mb-4 pr-1 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">{{ $movie->overview }}</p>
                    @else
                        <p class="text-gray-600 text-sm h-32 overflow-y-auto mb-4 pr-1 flex items-center justify-center italic">No overview available</p>
                    @endif
                    <div class="text-xs text-gray-500 mt-auto">
                        ID: {{ $movie->tmdb_id }} | Genres: {{ $movie->genres->pluck('name')->join(', ') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $movies->links() }}
    </div>
</div>
