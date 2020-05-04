@if(!$server->installed_at)
    <span class="text-inherit badge badge-warning">Installing</span>
@elseif($deploy = $server->getDeploy())
    @include('deploy.status')
@else
    <span class="text-inherit badge badge-dark">Stopped</span>
@endif
