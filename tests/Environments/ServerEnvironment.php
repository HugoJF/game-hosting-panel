<?php

namespace Tests\Environments;

use App\Server;
use Tests\Environments\Factories\ServerFactory;

class ServerEnvironment extends UserEnvironment
{
    public function __construct()
    {
        parent::__construct();

        $this->registerFactory(ServerFactory::class);
    }

    public function resolveDependencies(): void
    {
        parent::resolveDependencies();

        $this->serverFactory()->create();
    }

    public function serverFactory(): ServerFactory
    {
        return $this->dependency(ServerFactory::class);
    }

    public function server(): Server
    {
        return $this->serverFactory()->model();
    }
}
