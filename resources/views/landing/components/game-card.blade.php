<div class="bg-white rounded shadow overflow-hidden">
    <img src="{{ $img }}" alt="{{ $alt }}">
    <!-- Specs -->
    <div class="flex flex-col items-center p-4">
        <p class="text-sm text-gray-light">
            {{ $description }}
        </p>

        <div class="text-center text-lg lg:text-2xl xl:text-2xl text-gray-primary font-normal">
            {{ $specs }}
        </div>

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
