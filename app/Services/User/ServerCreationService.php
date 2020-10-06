<?php

namespace App\Services\User;

use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\InvalidBillingPeriodException;
use App\Exceptions\InvalidPeriodCostException;
use App\Exceptions\TooManyServersException;
use App\Game;
use App\Jobs\ServerCreationMonitor;
use App\Node;
use App\Notifications\ServerCreated;
use App\Server;
use App\User;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Allocation;
use HCGCloud\Pterodactyl\Resources\Server as ServerResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServerCreationService
{
    protected UserPreChecks $preChecks;
    protected Pterodactyl $pterodactyl;
    protected ServerCreationConfigService $configService;
    protected AllocationSelectionService $allocationService;

    public function __construct(
        UserPreChecks $preChecks,
        Pterodactyl $pterodactyl,
        ServerCreationConfigService $configService,
        AllocationSelectionService $allocationService
    ) {
        $this->preChecks = $preChecks;
        $this->pterodactyl = $pterodactyl;
        $this->configService = $configService;
        $this->allocationService = $allocationService;
    }

    public function handle(User $user, Game $game, Node $node, array $data, array $form): ?Server
    {
        return DB::transaction(fn() => $this->create($user, $game, $node, $data, $form));
    }

    /**
     * @param User  $user
     * @param Game  $game
     * @param Node  $node
     * @param array $data
     *
     * @param array $form
     *
     * @return Server
     * @throws InsufficientBalanceException
     * @throws InvalidBillingPeriodException
     * @throws InvalidPeriodCostException
     * @throws TooManyServersException
     */
    public function create(User $user, Game $game, Node $node, array $data, array $form): Server
    {
        $this->preChecks($user, $node, $data['billing_period'], $data);

        // Find an allocation
        $allocation = $this->allocationService->handle($node);

        // Register server on database
        $server = $this->preCreateServerModel($user, $node, $game, $allocation, $data, $form);

        // Generate config
        $config = $this->configService->handle($user, $node, $game, $server, $allocation, $data);

        // Create server on panel
        $resource = $this->pterodactyl->createServer($config);

        // TODO: temporary check since we disabled non-useful validation messages from panel.
        if (!($resource instanceof ServerResource)) {
            logger()->error($resource);
            throw new Exception('Pterodactyl API returned non-resource');
        }

        // Attach panel_id to server
        $this->attachPanelId($server, $resource->id, $resource->identifier);

        // Dispatch job that will monitor when server is installed
        $this->dispatchMonitoringJob($server);

        $user->notify(new ServerCreated($server));

        return $server;
    }

    /**
     * @param User   $user
     * @param Node   $node
     * @param string $billingPeriod
     * @param array  $config
     *
     * @throws InsufficientBalanceException
     * @throws InvalidBillingPeriodException
     * @throws InvalidPeriodCostException
     * @throws TooManyServersException
     */
    public function preChecks(User $user, Node $node, string $billingPeriod, array $config): void
    {
        $this->preChecks->handle($user, $node, $billingPeriod, $config);

        if ($user->servers()->count() >= $user->server_limit) {
            throw new TooManyServersException;
        }
    }

    protected function preCreateServerModel(
        User $user,
        Node $node,
        Game $game,
        Allocation $allocation,
        array $config,
        array $form
    ): Server {
        $server = new Server;

        // TODO: why this is not in config
        $fromDefaults = ['io' => 500];
        $fromConfig = collect($config)->only(['cpu', 'memory', 'disk', 'databases', 'billing_period'])->toArray();
        $otherAttributes = [
            'name'    => $config['name'] ?? Str::random(),
            'hash'    => Str::random(),
            'ip'      => "$allocation->ip:$allocation->port",
            'form'    => $form,
            'user_id' => $user->id,
            'game_id' => $game->id,
            'node_id' => $node->id,
        ];

        $server->forceFill(array_merge($fromDefaults, $fromConfig, $otherAttributes))->save();

        return $server;
    }

    protected
    function attachPanelId(
        Server $server,
        int $id,
        string $hash
    ): void {
        $server->panel_id = $id;
        $server->panel_hash = $hash;

        $server->save();
    }

    protected
    function dispatchMonitoringJob(
        Server $server
    ): void {
        dispatch(new ServerCreationMonitor($server));
    }
}
