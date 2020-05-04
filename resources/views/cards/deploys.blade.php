<div class="p-4 pt-10 grid grid-cols-1 gap-4">
    @foreach ($deploys as $deploy)
        <div class="flex items-stretch bg-white border rounded-lg overflow-hidden shadow">
            <!-- Accent -->
            @if($deploy->terminated_at)
                <div class="w-2 bg-gray-600"></div>
            @elseif($deploy->termination_requested_at)
                <div class="w-2 bg-yellow-600"></div>
            @else
                <div class="w-2 bg-blue-600"></div>
        @endif

        <!-- Body -->
            <div class="p-8 flex-grow bg-white">
                <!-- Started  -->
                <div class="mb-2 flex justify-between">
                    @if($deploy->created_at)
                        <p class="text-sm text-gray-400 font-light tracking-tight">Created at {{ $deploy->created_at }}</p>
                    @endif
                    @if($deploy->terminated_at)
                        <p class="text-sm text-gray-400 font-light tracking-tight">Terminated at {{ $deploy->terminated_at }}</p>
                    @elseif($deploy->termination_requested_at)
                        <p class="text-sm text-gray-400 font-light tracking-tight">Termination requested at {{ $deploy->termination_requested_at }}</p>
                    @endif
                </div>

                <!-- Header + Status -->
                <div class="mb-6 flex items-center">
                    <h2 class="mr-auto text-2xl text-gray-700 font-normal">
                        Deploy
                        <span class="py-1 px-2 bg-red-200 text-red-800 font-mono tracking-tight rounded">{{ Uuid::generate()->string }}</span>
                    </h2>

                    <span class="text-xl">
                        @include('deploy.status')
                    </span>
                </div>

                <!-- Information -->
                <div class="grid grid-cols-2 gap-8">
                    <div class="flex-grow">
                        <div class="flex py-2 justify-between border-b border-gray-100">
                            <p>
                                <span class="inline text-gray-600" data-feather="cpu"></span>
                                <span class="text-gray-900 font-semibold">CPU</span>
                            </p>
                            <span class="text-gray-700">{{ round($deploy->cpu) }}%</span>
                        </div>
                        <div class="flex py-2 justify-between border-b border-gray-100">
                            <p>
                                <span class="inline text-gray-600" data-feather="database"></span>
                                <span class="text-gray-900 font-semibold">RAM</span>
                            </p>
                            <span class="text-gray-700">{{ number_format($deploy->memory) }} MB</span>
                        </div>
                        <div class="flex py-2 justify-between border-b border-gray-100">
                            <p>
                                <span class="inline text-gray-600" data-feather="hard-drive"></span>
                                <span class="text-gray-900 font-semibold">Disk</span>
                            </p>
                            <span class="text-gray-700">{{ $deploy->disk / 1000 }} GB</span>
                        </div>
                        <div class="flex py-2 justify-between">
                            <p>
                                <span class="inline text-gray-600" data-feather="archive"></span>
                                <span class="text-gray-900 font-semibold">Databases</span>
                            </p>
                            <span class="text-gray-700">{{ $deploy->databases }} </span>
                        </div>
                    </div>


                    <div class="flex-grow">
                        <div class="flex py-2 justify-between border-b border-gray-100">
                            <p>
                                <span class="inline text-gray-600" data-feather="pie-chart"></span>
                                <span class="text-gray-900 font-semibold">Billing period</span>
                            </p>
                            <div>
                                <span class="text-base badge badge-secondary">{{ ucfirst($deploy->billing_period) }}</span>
                            </div>
                        </div>
                        <div class="flex py-2 justify-between border-b border-gray-100">
                            <p>
                                <span class="inline text-gray-600" data-feather="refresh-cw"></span>
                                <span class="text-gray-900 font-semibold">Period cost</span>
                            </p>
                            <span class="text-gray-700">R$ {{ number_format(abs($deploy->cost_per_period) / 100, 2) }}</span>
                        </div>
                        <div class="flex py-2 justify-between border-b border-gray-100">
                            <p>
                                <span class="inline text-gray-600" data-feather="dollar-sign"></span>
                                <span class="text-gray-900 font-semibold">Total cost</span>
                            </p>
                            <span class="text-gray-700">R$ {{ number_format(abs($deploy->transaction->value) / 100, 2) }}</span>
                        </div>
                        <div class="flex py-2 justify-between">
                            <p>
                                <span class="inline text-gray-600" data-feather="clock"></span>
                                <span class="text-gray-900 font-semibold">Duration</span>
                            </p>
                            @if($deploy->terminated_at)
                                <span class="text-gray-700">{{ $deploy->terminated_at->longAbsoluteDiffForHumans($deploy->created_at) }}</span>
                            @else
                                <span class="text-gray-700">{{ $deploy->created_at->longAbsoluteDiffForHumans() }}</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <div>

            </div>
        </div>
    @endforeach
</div>
