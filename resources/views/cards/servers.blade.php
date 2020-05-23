<div class="grid grid-col-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    @foreach ($servers as $server)
        <div class="trans flex flex-col justify-between bg-white border rounded-lg overflow-hidden hover:shadow hover:border-gray-400">
            <a class="flex flex-grow flex-col p-4" href="{{ route('servers.show', $server) }}">
                <!-- Header -->
                <div class="flex flex-wrap justify-between items-center text-base">
                    <h2 class="text-lg font-normal font-mono tracking-tight">
                        {{ $server->name }}
                    </h2>
                    @include('servers.status')
                </div>

                <!-- Game -->
                <p class="mb-4 text-xs text-gray-600">
                    {{ '~' . $server->game->name . '@' . $server->node->name }}
                </p>

                <!-- IP -->
                @if($server->ip)
                    <p class="text-xs text-center font-mono font-semibold select-all">
                        <span class="px-2 py-1 bg-gray-100 rounded">
                            {{ $server->ip }}
                        </span>
                    </p>
                @endif

                <!-- Specs -->
                <div class="flex flex-col flex-grow justify-end">
                    <div class="flex py-2 justify-between border-b border-gray-100">
                        <p>
                            <span class="inline text-gray-600" data-feather="cpu"></span>
                            <span class="text-gray-700 font-semibold">
                                @lang('words.cpu')
                            </span>
                        </p>
                        <span class="text-gray-700">
                            {{ round($server->cpu) }}%
                        </span>
                    </div>
                    <div class="flex py-2 justify-between border-b border-gray-100">
                        <p>
                            <span class="inline text-gray-600" data-feather="database"></span>
                            <span class="text-gray-700 font-semibold">
                                @lang('words.ram')
                            </span>
                        </p>
                        <span class="text-gray-700">
                            {{ number_format($server->memory) }} MB
                        </span>
                    </div>
                    <div class="flex py-2 justify-between border-b border-gray-100">
                        <p>
                            <span class="inline text-gray-600" data-feather="hard-drive"></span>
                            <span class="text-gray-700 font-semibold">
                                @lang('words.disk')
                            </span>
                        </p>
                        <span class="text-gray-700">
                            {{ $server->disk / 1000 }} GB
                        </span>
                    </div>
                    <div class="flex py-2 justify-between">
                        <p>
                            <span class="inline text-gray-600" data-feather="archive"></span>
                            <span class="text-gray-700 font-semibold">
                                @lang('words.databases')
                            </span>
                        </p>
                        <span class="text-gray-700">
                            {{ $server->databases }}
                        </span>
                    </div>
                </div>
            </a>

            <!-- Footer -->
            <div class="flex p-4 bg-gray-100 border-t ">
                <p class="flex-grow">
                    @if($server->getDeploy())
                        <a class="text-blue-500 text-base font-semibold" href="{{ config('pterodactyl.url') }}/server/{{ $server->panel_hash }}">
                            @lang('words.go_to_panel')
                        </a>
                    @else
                        <a class="text-blue-500 text-base font-semibold" href="{{ route('servers.deploy', $server) }}">
                            @lang('words.deploy')
                        </a>
                    @endif
                </p>
                <div class="flex items-items-center pl-3 border-l border-gray-300">
                    @if($deploy = $server->getDeploy())
                        <a data-toggle="tooltip"
                           data-placement="bottom"
                           title="Servidor será cobrado um novo período em {{ $deploy->getNextBillablePeriod()->longAbsoluteDiffForHumans() }}"
                        >
                            <span class="trans text-gray-600 hover:text-gray-700 cursor-pointer" data-feather="clock"></span>
                        </a>
                    @endif

                    <a href="{{ route('servers.configure', $server) }}">
                        <span class="trans ml-1 text-gray-600 hover:text-gray-700" data-feather="settings"></span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if($servers->count() === 0)
    <div>
        <h2 class="text-center">
            @lang('servers.no_servers_yet')
        </h2>
        <p class="text-center font-light tracking-tight">
            <a class="underline" href="#">
                @lang('servers.first_server_help')
            </a>
        </p>
        <div class="btn-group mt-8 flex justify-center">
            <a class="btn btn-primary" href="{{ route('servers.create') }}">
                @lang('servers.create')
            </a>
            <a class="btn btn-outline-primary" href="{{ route('orders.create') }}">
                @lang('words.add_credits')
            </a>
            <a class="btn btn-outline-secondary" href="#">
                @lang('words.help')
            </a>
        </div>
    </div>
@endif
