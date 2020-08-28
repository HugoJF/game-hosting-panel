<!-- TODO: unused -->

<div class="flex justify-center p-4">
    @foreach ($locations as $location)
        <a
            class="trans flex w-1/3 mx-4 px-10 py-6 items-center justify-between rounded cursor-pointer border border-gray-400 hover:shadow hover:bg-gray-100"
            href="{{ route('servers.configure', [$game, $location]) }}"
        >
            <div class="h-16 w-16 mr-8">
                @include("flags." . ($location->flag ?? 'brazil'))
            </div>
            <div class="flex-grow">
                <h2 class="tracking-wide font-semibold">{{ $location->short }}</h2>
                <h4 class="mt-1 text-base text-gray-500 font-mono tracking-tight">{{ $location->long }}</h4>
            </div>
        </a>
    @endforeach
</div>
