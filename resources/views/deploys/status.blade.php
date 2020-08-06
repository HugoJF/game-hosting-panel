@if($deploy->terminated_at)
    <span
        class="text-inherit badge badge-secondary"
        data-toggle="tooltip"
        data-placement="bottom"
        title="@lang("servers.$deploy->termination_reason")"
    >
        @lang('words.terminated')
    </span>
@elseif($deploy->termination_requested_at)
    <span class="text-inherit badge badge-warning">
        @lang('words.terminating')
    </span>
@else
    <span class="text-inherit badge badge-success">
        @lang('words.running')
    </span>
@endif
