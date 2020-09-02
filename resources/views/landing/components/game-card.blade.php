<div class="bg-white rounded shadow overflow-hidden">
    <img src="{{ $img }}" alt="{{ $alt }}">
    <!-- Specs -->
    <div class="flex flex-col items-center p-4">
        <div class="text-center text-sm lg:text-base xl:text-lg text-gray-primary font-normal">
            {{ $specs }}
        </div>

        <p class="mb-2 text-sm text-gray-light">
            {{ $description }}
        </p>

        <!-- Price -->
        <div class="text-2xl lg:text-3xl text-blue-dark font-semibold">
            R$ {{ number_format((float) $price, 2, ',', '.') }}
            <small class="block md:inline leading-none md:leading-normal text-center text-base xl:text-lg text-gray-primary font-normal tracking-tighter">
                {{ $period }}
            </small>
        </div>
    </div>
</div>
