<div class="hidden md:flex flex-col px-20 mt-4 mb-6 items-center">
    @auth
{{--        <div class="top-0 self-center p-4 justify-center items-center bg-white rounded-full shadow sm:flex">--}}
{{--            <img class="h-28 w-28 rounded-full" src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/45/45be9bd313395f74762c1a5118aee58eb99b4688_full.jpg"/>--}}
{{--        </div>--}}
        @auth
            <a href="{{ route('orders.create') }}" class="flex items-center text-xl text-gray-200 font-semibold no-underline">
                <span class="mr-1 font-light">R$</span>
                <span>{{ number_format(Auth::user()->balance / 100, 2) }}</span>
                <span class="m-0 ml-2 inline hover:text-white cursor-pointer" data-feather="plus-circle"></span>
            </a>
        @endauth
    @endauth
</div>
