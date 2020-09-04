<div class="grid grid-col-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    @foreach ($servers as $server)
        <div class="trans flex flex-col justify-between bg-white border border-gray-300 rounded-lg overflow-hidden hover:shadow hover:border-gray-400">
            <a class="flex flex-grow flex-col p-4" href="{{ route('servers.show', $server) }}">
                <!-- Header -->
                <div class="flex justify-between items-center text-base">
                    <h2 class="mr-2 text-lg font-normal font-mono tracking-tight truncate" title="{{ $server->name }}">
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
                    <!-- CPU -->
                    <div class="flex py-2 justify-between border-b border-gray-100">
                        <p>
                            <span class="inline text-gray-600" data-feather="cpu"></span>
                            <span class="text-gray-700 font-semibold">
                                @lang('words.cpu')
                            </span>
                        </p>
                        <span class="text-gray-700">
                            {{ round($server->cpu) }} marks
                        </span>
                    </div>

                    <!-- Memory -->
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

                    <!-- Disk -->
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

                    <!-- Databases -->
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
            <div class="flex p-4 bg-gray-100 border-t border-gray-300">
                <p class="flex-grow">
                    @if($server->getDeploy())
                        <a class="text-blue-500 text-base font-semibold" href="{{ config('pterodactyl.url') }}/server/{{ $server->panel_hash }}">
                            @lang('words.go_to_panel')
                        </a>
                    @else
                        <a class="text-blue-500 text-base font-semibold" href="{{ route('servers.show', $server) }}">
                            @lang('words.view')
                        </a>
                    @endif
                </p>
                <div class="flex items-items-center pl-3 border-l border-gray-300">
                    @if($deploy = $server->getDeploy())
                        <a data-toggle="tooltip"
                           data-placement="bottom"
                           title="Servidor será cobrado um novo período em {{ $deploy->getNextBillablePeriod()->longAbsoluteDiffForHumans() }}"
                        >
                            <span class="trans text-gray-600 hover:text-gray-700" data-feather="clock"></span>
                        </a>
                    @else
                        <a href="{{ route('servers.deploying', $server) }}" title="Deploy server">
                            <span class="trans ml-1 text-gray-600 hover:text-gray-700" data-feather="play"></span>
                        </a>
                        <a href="{{ route('servers.configure', $server) }}" title="Configure server">
                            <span class="trans ml-1 text-gray-600 hover:text-gray-700" data-feather="settings"></span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

@if($servers->isEmpty())
    <div>
        <!-- Title -->
        <h2 class="text-3xl text-center">
            @lang('servers.no_servers_yet')
        </h2>

        <!-- Actions -->
        <div class="btn-group btn-group-lg my-8 flex justify-center">
            <a class="btn btn-lg btn-primary" href="{{ route('servers.create') }}">
                @lang('servers.create')
            </a>
            <a class="btn btn-lg btn-outline-primary" href="{{ route('orders.create') }}">
                @lang('words.add_credits')
            </a>

            <a class="btn btn-lg btn-outline-secondary" href="https://denerdtv.com/discord">
                @lang('words.help')
            </a>
        </div>

        <!-- Help text -->
        <p class="text-center text-gray-500 text-base font-light tracking-tight">
            <a class="underline" href="https://denerdtv.com/discord">
                @lang('servers.first_server_help')
            </a>
        </p>
    </div>
@endif
