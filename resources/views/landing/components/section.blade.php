<div class="flex flex-col items-center justify-center w-full {{ $theme }}-section">
    <h1 class="text-5xl text-center font-bold">{{ $title }}</h1>
    <h2 class="text-xl tracking-tighter">{{ $description }}</h2>

    <div class="container">
        {{ $slot }}
    </div>
</div>
