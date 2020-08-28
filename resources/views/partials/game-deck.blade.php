<!-- TODO: unused -->

<div class="flex justify-center items-stretch flex-wrap p-4">
    @foreach ($games as $game)
        <div class="w-1/4 p-4">
            <a
                class="
                    trans flex flex-column justify-between h-full
                    items-center rounded cursor-pointer rounded-lg
                    hover:shadow-lg
                "
                href="{{ route('servers.select-location', $game) }}"
            >
                @if($game->cover)
                    <img class="rounded-t-lg" src="{{ $game->cover }}" alt="{{ $game->name }} cover">
                @else
                    <img class="rounded-t-lg" src="https://picsum.photos/500/500?grayscale" alt="{{ $game->name }} cover">
                @endif
                <div class="flex flex-column flex-grow w-full p-4 bg-gray-100 border border-t-0 border-gray-300 tracking-normal rounded-b-lg">
                    <div class="flex-grow"><!-- I'm used as a vertical spacer --></div>
                    <h3 class="font-normal text-gray-700 text-center tracking-wide">{{ $game->name }}</h3>
                </div>
            </a>
        </div>
    @endforeach
</div>
