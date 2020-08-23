@for($i = 0; $i < $count; $i++)
    @if((int) $selected === $i)
        <div class="h-3 w-3 m-3 mt-6 carousel-selected rounded-full"></div>
    @else
        <div class="h-3 w-3 m-3 mt-6 carousel-deselected rounded-full"></div>
    @endif
@endfor
