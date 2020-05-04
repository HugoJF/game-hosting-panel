@if(!$server->installed_at)
    <span class="badge badge-warning text-lg">Installing</span>
@elseif($deploy = $server->getDeploy())
    @include('deploy.status')
@else
    <span class="badge badge-dark text-lg">Stopped</span>
@endif
