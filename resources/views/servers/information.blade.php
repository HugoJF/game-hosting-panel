<x-well>
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
                {{ round($server->cpu) }} marks
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
                {{ number_format($server->memory) }} MB
            </span>
            </div>

            <!-- Disk -->
            <div class="flex py-2 justify-between lg:border-noneborder-gray-100">
                <p>
                    <span class="inline text-gray-600" data-feather="hard-drive"></span>
                    <span class="text-gray-900 font-semibold">
                    @lang('words.disk')
                </span>
                </p>
                <span class="text-gray-700">
                {{ $server->disk / 1000 }} GB
            </span>
            </div>
        </div>

        <div class="flex-grow">
            <!-- Databases -->
            <div class="flex py-2 justify-between border-b border-gray-100">
                <p>
                    <span class="inline text-gray-600" data-feather="archive"></span>
                    <span class="text-gray-900 font-semibold">
                    @lang('words.databases')
                </span>
                </p>
                <span class="text-gray-700">
                {{ $server->databases }}
            </span>
            </div>

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
                    {{ ucfirst($server->billing_period) }}
                </span>
                </div>
            </div>

            <!-- Period cost -->
            <div class="flex py-2 justify-between lg:border-none border-gray-100">
                <p>
                    <span class="inline text-gray-600" data-feather="refresh-cw"></span>
                    <span class="text-gray-900 font-semibold">
                    @lang('words.period_cost')
                </span>
                </p>
                <span class="text-gray-700">
                R$ {{ number_format(abs($costPerPeriod) / 100, 2) }}
            </span>
            </div>
        </div>
    </div>

</x-well>
