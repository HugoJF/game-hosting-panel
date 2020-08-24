<div class="flex flex-col items-center justify-center w-full py-16 px-8 {{ $theme }}-section">
    <h1 class="text-3xl md:text-5xl text-center font-bold">{{ $title }}</h1>
    @if($description)
        <h2 class="text-base md:text-xl text-center tracking-tighter">{{ $description }}</h2>
    @endif

    <div class="container pt-16">
        {{ $slot }}
    </div>
</div>
