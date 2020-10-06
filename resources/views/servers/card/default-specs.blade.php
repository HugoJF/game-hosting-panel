<!-- CPU -->
<div class="flex py-2 justify-between border-b border-gray-100">
    <p>
        <span class="inline text-gray-600" data-feather="cpu"></span>
        <span class="text-gray-700 font-semibold">@lang('words.cpu')</span>
    </p>
    <span class="text-gray-700">{{ round($server->cpu) }} marks</span>
</div>

<!-- Memory -->
<div class="flex py-2 justify-between border-b border-gray-100">
    <p>
        <span class="inline text-gray-600" data-feather="database"></span>
        <span class="text-gray-700 font-semibold">@lang('words.ram')</span>
    </p>
    <span class="text-gray-700">{{ number_format($server->memory) }} MB</span>
</div>

<!-- Disk -->
<div class="flex py-2 justify-between border-b border-gray-100">
    <p>
        <span class="inline text-gray-600" data-feather="hard-drive"></span>
        <span class="text-gray-700 font-semibold">@lang('words.disk')</span>
    </p>
    <span class="text-gray-700">{{ $server->disk / 1000 }} GB</span>
</div>

<!-- Databases -->
<div class="flex py-2 justify-between">
    <p>
        <span class="inline text-gray-600" data-feather="archive"></span>
        <span class="text-gray-700 font-semibold">@lang('words.databases')</span>
    </p>
    <span class="text-gray-700">{{ $server->databases }}</span>
</div>
