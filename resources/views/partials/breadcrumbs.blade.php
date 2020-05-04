@if (count($breadcrumbs))
    <ol class="flex items-center">
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li>{{ $breadcrumb->title }}</li>
            @endif

            @if(!$loop->last)
                <span class="mr-1 w-4 h-4 select-none inline text-gray-700" data-feather="chevron-right"></span>
            @endif

        @endforeach
    </ol>
@endif
