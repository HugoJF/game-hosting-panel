@php
    $color = $color ?? 'blue';
    $mod = $color === 'yellow' ? '-600' : '';
    $text = $text ?? '';
    $pulse = $pulse ?? false;
@endphp

<div class="inline-block py-0 px-2 bg-{{ $color }}{{ $mod }} {{ $pulse ? 'pulse-' . $color : '' }} font-semibold text-{{ $color }}-100 text-sm rounded-lg">
    {{ $text }}
</div>
