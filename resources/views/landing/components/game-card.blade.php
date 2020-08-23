<div class="bg-white rounded shadow overflow-hidden">
    <img src="{{ $img }}" alt="{{ $alt }}">
    <!-- Specs -->
    <div class="flex flex-col items-center p-4">
        <div class="mb-2 text-sm text-gray-light">
            {{ $specs }}
        </div>

        <!-- Price -->
        <div class="text-2xl text-blue-dark font-semibold">
            R$ {{ number_format((float) $price, 2, ',', '.') }}
            <small class="text-sm text-gray-light font-normal tracking-tighter">
                {{ $period }}
            </small>
        </div>
    </div>
</div>
