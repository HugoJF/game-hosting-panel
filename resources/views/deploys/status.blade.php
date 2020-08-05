@if($deploy->terminated_at)
    <span class="text-inherit badge badge-secondary">
        @lang('words.terminated')
    </span>
@elseif($deploy->termination_requested_at)
    <span class="text-inherit badge badge-warning">
        @lang('words.terminating')
    </span>
@else
    <span class="text-inherit badge badge-primary">
        @lang('words.running')
    </span>
@endif
