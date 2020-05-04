@if($deploy->terminated_at)
    <span class="text-inherit badge badge-secondary">Terminated</span>
@elseif($deploy->termination_requested_at)
    <span class="text-inherit badge badge-warning">Terminating</span>
@else
    <span class="text-inherit badge badge-primary">Running</span>
@endif
