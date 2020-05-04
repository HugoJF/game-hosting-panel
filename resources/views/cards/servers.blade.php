<div class="grid grid-cols-4 gap-4 p-8">
    @foreach ($servers as $server)
        <div class="bg-white border rounded-lg overflow-hidden hover:shadow">
            <a class="block p-4" href="{{ route('servers.show', $server) }}">
                <!-- Header -->
                <div class="flex mb-4 justify-between items-center">
                    <h2 class="text-xl font-normal font-mono tracking-tight">{{ $server->name }}</h2>
                    @include('servers.status')
                </div>

                <!-- Specs -->
                <div class="">
                    <div class="flex py-2 justify-between border-b border-gray-100">
                        <p>
                            <span class="inline text-gray-600" data-feather="cpu"></span>
                            <span class="text-gray-900 font-semibolda">CPU</span>
                        </p>
                        <span class="text-gray-700">{{ round($server->cpu) }}%</span>
                    </div>
                    <div class="flex py-2 justify-between border-b border-gray-100">
                        <p>
                            <span class="inline text-gray-600" data-feather="database"></span>
                            <span class="text-gray-900 font-semibolda">RAM</span>
                        </p>
                        <span class="text-gray-700">{{ number_format($server->memory) }} MB</span>
                    </div>
                    <div class="flex py-2 justify-between">
                        <p>
                            <span class="inline text-gray-600" data-feather="hard-drive"></span>
                            <span class="text-gray-900 font-semibolda">Disk</span>
                        </p>
                        <span class="text-gray-700">{{ $server->disk / 1000 }} GB</span>
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
                    <a href="{{ route('servers.custom-deploy', $server) }}"><span class="inline text-gray-600" data-feather="settings"></span></a>
                </div>
            </div>
        </div>
    @endforeach
</div>
