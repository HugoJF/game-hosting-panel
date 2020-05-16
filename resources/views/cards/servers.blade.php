<div class="grid grid-col-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    @foreach ($servers as $server)
        <div class="trans flex flex-col justify-between bg-white border rounded-lg overflow-hidden hover:shadow hover:border-gray-400">
            <a class="flex flex-grow flex-col p-4" href="{{ route('servers.show', $server) }}">
                <!-- Header -->
                <div class="flex flex-wrap justify-between items-center text-base">
                    <h2 class="text-lg font-normal font-mono tracking-tight">{{ $server->name }}</h2>
                    @include('servers.status')
                </div>

                <!-- Game -->
                <p class="mb-4 text-xs text-gray-600">
                    ~{{ $server->game->name }}
                </p>

                <!-- IP -->
                <p class="text-xs text-center font-mono font-semibold select-all">
                    <span class="px-2 py-1 bg-gray-100 rounded">{{ $server->ip }}</span>
                </p>

                <!-- Specs -->
                <div class="flex flex-col flex-grow justify-end">
                    <div class="flex py-2 justify-between border-b border-gray-100">
                        <p>
                            <span class="inline text-gray-600" data-feather="cpu"></span>
                            <span class="text-gray-700 font-semibold">CPU</span>
                        </p>
                        <span class="text-gray-700">{{ round($server->cpu) }}%</span>
                    </div>
                    <div class="flex py-2 justify-between border-b border-gray-100">
                        <p>
                            <span class="inline text-gray-600" data-feather="database"></span>
                            <span class="text-gray-700 font-semibold">RAM</span>
                        </p>
                        <span class="text-gray-700">{{ number_format($server->memory) }} MB</span>
                    </div>
                    <div class="flex py-2 justify-between border-b border-gray-100">
                        <p>
                            <span class="inline text-gray-600" data-feather="hard-drive"></span>
                            <span class="text-gray-700 font-semibold">Disk</span>
                        </p>
                        <span class="text-gray-700">{{ $server->disk / 1000 }} GB</span>
                    </div>
                    <div class="flex py-2 justify-between">
                        <p>
                            <span class="inline text-gray-600" data-feather="archive"></span>
                            <span class="text-gray-700 font-semibold">Databases</span>
                        </p>
                        <span class="text-gray-700">{{ $server->databases }}</span>
                    </div>
                </div>
            </a>

            <!-- Footer -->
            <div class="flex p-4 bg-gray-100 border-t ">
                <p class="flex-grow">
                    @if($server->currentDeploy()->exists())
                        <a class="text-blue-500 text-base font-semibold" href="#">Go to panel</a>
                    @else
                        <a class="text-blue-500 text-base font-semibold" href="#">Deploy</a>
                    @endif
                </p>
                <div class="pl-3 border-l border-gray-300">
                    <a href="{{ route('servers.custom-deploy', $server) }}">
                        <span class="trans inline text-gray-600 hover:text-gray-700" data-feather="settings"></span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
