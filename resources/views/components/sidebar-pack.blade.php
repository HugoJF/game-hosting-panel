<a class="flex justify-between items-center px-3 mb-4 uppercase font-normal tracking-wider text-gray-700" data-toggle="collapse" href="#{{ $id }}">
    <span class="md:hidden" data-feather="menu"></span>
    <span>{{ $title }}</span>
    <span class="ml-4 mt-px flex-grow border-b border-dashed border-gray-800"></span>
</a>

<div id="{{ $id }}" class="collapse">
    {{ $slot }}
</div>
