@auth
    @isset($onlineServers)
        @component('components.sidebar-pack', ['id' => 'servers'])
            @slot('title')
                Servers online {{ $onlineServers->count() }} / {{ $totalServers }}
            @endslot
            <ul class="ml-3 mr-2 mb-6 grid grid-cols-2 lg:grid-cols-1 lg:grid-cols-2 gap-2">
                @foreach ($onlineServers as $server)
                    <li>
                        <a class="trans inline py-1 flex justify-center items-center hover:bg-gray-800 cursor-pointer rounded" href="{{ route('servers.show', $server) }}">
                            <div class="flex-shrink-0 mr-4 h-2 w-2 bg-green-600 rounded-full"></div>
                            <p class="text-gray-400 text-sm lg:text-xs xl:text-sm font-mono">{{ $server->name }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endcomponent
    @endisset
@endauth
