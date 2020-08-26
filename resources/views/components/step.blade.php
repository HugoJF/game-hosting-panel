<div class="flex flex-col mx-auto items-center px-8 mt-8 first:mt-0 md:mt-0">
    <div class="flex items-center">
        <div class="w-6 h-1 dash"></div>
        <h1 class="mx-3 text-5xl">{{ $number }}</h1>
        <div class="w-6 h-1 dash"></div>
    </div>

    <h3 class="my-3 text-blue-light text-xl">{{ $slot }}</h3>

    <img class="rounded shadow" src="{{ $image }}" alt="{{ $slot }}">
</div>
