@forelse ($deploys as $deploy)
    <x-well>

        <!-- Started  -->
        <div class="mb-2 flex flex-col lg:flex-row justify-between">
            @if($deploy->created_at)
                <p class="text-sm text-gray-400 font-light tracking-tight">
                    @lang('words.created_at'):
                    {{ $deploy->created_at }}
                </p>
            @endif
            @if($deploy->terminated_at)
                <p class="text-sm text-gray-400 font-light tracking-tight">
                    @lang('words.terminated_at'):
                    {{ $deploy->terminated_at }}
                </p>
            @elseif($deploy->termination_requested_at)
                <p class="text-sm text-gray-400 font-light tracking-tight">
                    @lang('words.termination_requested_at'):
                    {{ $deploy->termination_requested_at }}
                </p>
            @endif
        </div>

        <!-- Header + Status -->
        <div class="mb-6 flex flex-col lg:flex-row items-center">
            <h2 class="mb-4 lg:mr-auto text-center text-base md:text-lg lg:text-2xl text-gray-700 font-normal">
                    <span class="hidden xl:inline">
                        @lang('words.deploy')
                    </span>
                <span class="py-1 px-2 bg-red-200 text-red-800 font-mono tracking-tight break-words select-all rounded">
                        {{ $deploy->id }}
                    </span>
            </h2>

            <span class="text-base lg:text-xl">
                    @include('deploys.status')
                </span>
        </div>

        <!-- Information -->
        <div class="grid grid-cols-1 lg:grid-cols-2 col-gap-8">
            <div class="flex-grow">
                <!-- CPU -->
                <div class="flex py-2 justify-between border-b border-gray-100">
                    <p>
                        <span class="inline text-gray-600" data-feather="cpu"></span>
                        <span class="text-gray-900 font-semibold">
                                @lang('words.cpu')
                            </span>
                    </p>
                    <span class="text-gray-700">
                            {{ round($deploy->cpu) }} marks
                        </span>
                </div>

                <!-- RAM -->
                <div class="flex py-2 justify-between border-b border-gray-100">
                    <p>
                        <span class="inline text-gray-600" data-feather="database"></span>
                        <span class="text-gray-900 font-semibold">
                                @lang('words.ram')
                            </span>
                    </p>
                    <span class="text-gray-700">
                            {{ number_format($deploy->memory) }} MB
                        </span>
                </div>

                <!-- Disk -->
                <div class="flex py-2 justify-between border-b border-gray-100">
                    <p>
                        <span class="inline text-gray-600" data-feather="hard-drive"></span>
                        <span class="text-gray-900 font-semibold">
                                @lang('words.disk')
                            </span>
                    </p>
                    <span class="text-gray-700">
                            {{ $deploy->disk / 1000 }} GB
                        </span>
                </div>

                <!-- Databases -->
                <div class="flex py-2 justify-between border-b lg:border-none border-gray-100">
                    <p>
                        <span class="inline text-gray-600" data-feather="archive"></span>
                        <span class="text-gray-900 font-semibold">
                                @lang('words.databases')
                            </span>
                    </p>
                    <span class="text-gray-700">
                            {{ $deploy->databases }}
                        </span>
                </div>
            </div>

            <div class="flex-grow">
                <!-- Billing period -->
                <div class="flex py-2 justify-between border-b border-gray-100">
                    <p>
                        <span class="inline text-gray-600" data-feather="pie-chart"></span>
                        <span class="text-gray-900 font-semibold">
                                @lang('words.billing_period')
                            </span>
                    </p>
                    <div>
                            <span class="text-base badge badge-secondary">
                                {{ ucfirst($deploy->billing_period) }}
                            </span>
                    </div>
                </div>

                <!-- Period cost -->
                <div class="flex py-2 justify-between border-b border-gray-100">
                    <p>
                        <span class="inline text-gray-600" data-feather="refresh-cw"></span>
                        <span class="text-gray-900 font-semibold">
                                @lang('words.period_cost')
                            </span>
                    </p>
                    <span class="text-gray-700">
                            R$ {{ number_format(abs($deploy->cost_per_period) / 100, 2) }}
                        </span>
                </div>

                <!-- Total cost -->
                <div class="flex py-2 justify-between border-b border-gray-100">
                    <p>
                        <span class="inline text-gray-600" data-feather="dollar-sign"></span>
                        <span class="text-gray-900 font-semibold">
                                @lang('words.total_cost')
                            </span>
                    </p>
                    <span class="text-gray-700">
                            R$ {{ number_format(abs($deploy->transaction->value) / 100, 2) }}
                        </span>
                </div>

                <!-- Duration -->
                <div class="flex py-2 justify-between">
                    <p>
                        <span class="inline text-gray-600" data-feather="clock"></span>
                        <span class="text-gray-900 font-semibold">
                                @lang('words.duration')
                            </span>
                    </p>
                    @if($deploy->terminated_at)
                        <span class="text-gray-700">
                                {{ $deploy->terminated_at->longAbsoluteDiffForHumans($deploy->created_at) }}
                            </span>
                    @else
                        <span class="text-gray-700">
                                {{ $deploy->created_at->longAbsoluteDiffForHumans() }}
                            </span>
                    @endif
                </div>
            </div>
        </div>
    </x-well>
@empty
    <x-well>
        <div class="flex flex-col items-center">
            <h2>
                @lang('deploys.no_deploys')
            </h2>
            <small class="text-sm text-gray-500 tracking-tight">
                @lang('servers.not_deployed_at')
            </small>
            <svg id="note" enable-background="new 0 0 300 300" height="250" viewBox="0 0 300 300" width="250b" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <circle cx="128" cy="154" fill="#edf2f7" r="86"/>
                    <g>
                        <path d="m148 80h-82v-13.109c0-10.433 8.458-18.891 18.891-18.891h63.109z" fill="#f7f7f7"/>
                        <path d="m148 84h-82c-2.209 0-4-1.791-4-4v-13.109c0-12.621 10.27-22.891 22.891-22.891h63.109c2.209 0 4 1.791 4 4v32c0 2.209-1.791 4-4 4zm-78-8h74v-24h-59.109c-8.211 0-14.891 6.68-14.891 14.891z" fill="#1a202c"/>
                    </g>
                    <g>
                        <path d="m84.894 48.019c10.659.451 17.106 9.004 17.106 19.981v157.217c0 14.792 9.208 26.783 24 26.783h96l16-11.944v-169.41c0-12.507-10.139-22.646-22.646-22.646h-129.354z" fill="#fff"/>
                        <path d="m222 256h-96c-16.225 0-28-12.945-28-30.783v-157.217c0-9.369-5.211-15.643-13.275-15.984-2.16-.092-3.855-1.883-3.83-4.045.027-2.162 1.768-3.912 3.93-3.951l1.105-.02h129.424c14.693 0 26.646 11.953 26.646 26.646v169.41c0 1.262-.596 2.451-1.607 3.205l-16 11.943c-.692.517-1.53.796-2.393.796zm-121.109-204c3.242 4.145 5.109 9.668 5.109 16v157.217c0 13.414 8.225 22.783 20 22.783h94.672l13.328-9.949v-167.405c0-10.281-8.365-18.646-18.646-18.646z" fill="#1a202c"/>
                    </g>
                    <g>
                        <path d="m126 252h108.888c10.555 0 19.112-8.557 19.112-19.112v-8.888h-108v6c0 11.659-9.069 21.199-20.537 21.952z" fill="#f7f7f7"/>
                        <path d="m234.889 256h-108.889c-.115 0-.232-.006-.348-.016l-.537-.047c-2.082-.182-3.674-1.936-3.652-4.027.023-2.09 1.65-3.811 3.738-3.949 9.42-.619 16.799-8.508 16.799-17.961v-6c0-2.209 1.791-4 4-4h108c2.209 0 4 1.791 4 4v8.889c0 12.744-10.367 23.111-23.111 23.111zm-92.153-8h92.152c8.332 0 15.111-6.779 15.111-15.111v-4.889h-99.999v2c0 6.945-2.76 13.309-7.264 18z" fill="#1a202c"/>
                    </g>
                    <g fill="#1a202c">
                        <path d="m59.656 201.656c-1.023 0-2.047-.391-2.828-1.172l-11.312-11.312c-1.562-1.562-1.562-4.094 0-5.656s4.094-1.562 5.656 0l11.312 11.312c1.562 1.562 1.562 4.094 0 5.656-.781.782-1.804 1.172-2.828 1.172z"/>
                        <path d="m48.344 201.656c-1.023 0-2.047-.391-2.828-1.172-1.562-1.562-1.562-4.094 0-5.656l11.312-11.312c1.562-1.562 4.094-1.562 5.656 0s1.562 4.094 0 5.656l-11.312 11.312c-.781.782-1.805 1.172-2.828 1.172z"/>
                        <circle cx="82" cy="180" r="4"/>
                        <circle cx="70" cy="136" r="4"/>
                    </g>
                </g>
            </svg>
            @isset($server)
                <a class="btn btn-primary btn-lg shadow" href="{{ route('servers.deploying', $server) }}">
                    @lang('servers.deploy_now')
                </a>
            @endisset
        </div>
    </x-well>
@endforelse
