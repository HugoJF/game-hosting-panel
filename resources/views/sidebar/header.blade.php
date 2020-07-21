<div class="hidden md:flex flex-col px-20 mt-2 mb-4 items-center">
    @auth
        @auth
            <a href="{{ route('orders.create') }}" class="flex items-center text-xl text-gray-200 font-semibold no-underline">
                <span class="mr-1 font-light">R$</span>
                <span>{{ number_format(Auth::user()->balance / 100, 2) }}</span>
                <span class="m-0 ml-2 inline hover:text-white cursor-pointer" data-feather="plus-circle"></span>
            </a>
        @endauth
    @endauth
</div>
