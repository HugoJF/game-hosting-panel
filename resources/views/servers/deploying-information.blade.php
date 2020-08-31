<x-well>
    <div class="grid grid-cols-2 gap-4">
        <!-- Deploy details -->
        <div>
            <h5 class="mb-1 text-gray-900 font-normal tracking-wide">
                <span class="inline text-gray-600" data-feather="activity"></span>
                @lang('deploying.deploying')
            </h5>
            <p class="text-sm text-gray-600 tracking-tight">
                @lang('deploying.deploying_body')
            </p>
        </div>

        <!-- Configuration details -->
        <div>
            <h5 class="mb-1 text-gray-900 font-normal tracking-wide">
                <span class="inline text-gray-600" data-feather="settings"></span>
                @lang('deploying.configuration')
            </h5>
            <p class="text-sm text-gray-600 tracking-tight">
                @lang('deploying.configuration_body')
            </p>
        </div>

        <!-- Costs details -->
        <div>
            <h5 class="mb-1 text-gray-900 font-normal tracking-wide">
                <span class="inline text-gray-600" data-feather="credit-card"></span>
                @lang('deploying.costs')
            </h5>
            <p class="text-sm text-gray-600 tracking-tight">
                @lang('deploying.costs_body', ['cost' => number_format(abs($costPerPeriod) / 100, 2)])
            </p>
        </div>

        <!-- Termination details -->
        <div>
            <h5 class="mb-1 text-gray-900 font-normal tracking-wide">
                <span class="inline text-gray-600" data-feather="power"></span>
                @lang('deploying.termination')
            </h5>
            <p class="text-sm text-gray-600 tracking-tight">
                @lang('deploying.termination_body')
            </p>
        </div>
    </div>
</x-well>
