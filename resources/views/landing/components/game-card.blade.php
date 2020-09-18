<div class="bg-white rounded shadow overflow-hidden">
    <img src="{{ $img }}" alt="{{ $alt }}">
    <!-- Specs -->
    <div class="flex flex-col items-center p-4">
        <!-- Game -->
        <h2 class="text-center text-xl text-gray-primary font-medium">
            {{ $game }}
        </h2>

        <!-- Specs -->
        <div class="mb-4 text-center text-lg lg:text-xl xl:text-xl text-gray-primary font-normal">
            {{ $specs }}
        </div>

        <!-- Description -->
        <p class="text-sm text-center text-gray-light tracking-tight">
            {{ $description }}
        </p>

        <!-- Hourly price -->
        <div class="text-xl lg:text-2xl text-blue-dark font-semibold">
            R$ {{ number_format((float) $hourlyPrice, 2, ',', '.') }}
            <small class="block md:inline leading-none md:leading-normal text-center text-base xl:text-lg text-gray-primary font-normal tracking-tighter">
                por hora
            </small>
        </div>

        <!-- Daily price -->
        <div class="text-2xl lg:text-3xl text-blue-dark font-semibold">
            R$ {{ number_format((float) $dailyPrice, 2, ',', '.') }}
            <small class="block md:inline leading-none md:leading-normal text-center text-base xl:text-lg text-gray-primary font-normal tracking-tighter">
                por dia
            </small>
        </div>
    </div>
</div>
