@if($deploy->terminated_at)
    <span class="text-lg badge badge-secondary">Terminated</span>
@elseif($deploy->termination_requested_at)
    <span class="text-lg badge badge-warning">Terminating</span>
@else
    <span class="text-lg badge badge-primary">Running</span>
@endif
