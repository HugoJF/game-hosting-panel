<div class="flex flex-col items-center mx-8">
    <div class="flex items-center">
        <div class="w-6 h-1 dash"></div>
        <h1 class="mx-3 text-5xl">{{ $number }}</h1>
        <div class="w-6 h-1 dash"></div>
    </div>

    <h3 class="my-3 text-blue-light text-xl">{{ $slot }}</h3>

    <img class="rounded shadow" src="{{ $image }}" alt="{{ $slot }}">
</div>
