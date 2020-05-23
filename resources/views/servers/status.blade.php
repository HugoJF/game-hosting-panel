@if(!$server->installed_at)
    <span class="text-inherit badge badge-warning">
        @lang('words.installing')
    </span>
@elseif($deploy = $server->getDeploy())
    @include('deploy.status')
@else
    <span class="text-inherit badge badge-dark">
        @lang('words.stopped')
    </span>
@endif
