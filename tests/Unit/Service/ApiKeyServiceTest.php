<?php

namespace Tests\Unit\Service;

use App\ApiKey;
use App\Services\ApiKeyService;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ApiKeyServiceTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    protected ApiKeyService $service;
    protected User $user;
    protected Carbon $lastUsedAt;
    protected array $create;
    protected array $update;
    protected array $extra;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(ApiKeyService::class);
        $this->user = factory(User::class)->create();
        $this->lastUsedAt = now()->subDay()->roundSecond();
        $this->create = [
            'description' => 'My key',
        ];
        $this->update = [
            'description' => 'New description',
        ];
        $this->extra = [
            'last_used_at' => $this->lastUsedAt,
        ];
    }

    public function test_store_will_fill_and_persist(): void
    {
        $key = $this->service->store($this->user, array_merge($this->create, $this->extra));

        $this->assertDatabaseHas('api_keys', $this->create);
        $this->assertEquals($key->id, ($key = $this->user->apiKeys->first())->id);
        $this->assertNotEquals($this->lastUsedAt, $key->last_used_at);
    }

    public function test_store_will_force_fill(): void
    {
        $key = $this->service->store($this->user, $this->create, $this->extra);

        $this->assertDatabaseHas('api_keys', $this->create);
        $this->assertEquals($key->id, ($key = $this->user->apiKeys->first())->id);
        $this->assertEquals($this->lastUsedAt, $key->last_used_at);
    }

    public function test_update_will_fill_and_persist(): void
    {
        $key = factory(ApiKey::class)->create(array_merge(
            $this->create,
            ['user_id' => $this->user->id],
        ));
        $this->service->update($key, array_merge($this->update, $this->extra));

        $this->assertDatabaseHas('api_keys', $this->update);

        $key = $this->user->apiKeys->first();
        $this->assertNotEquals($this->lastUsedAt, $key->last_used_at);
        $this->assertEquals($this->update['description'], $key->description);
    }

    public function test_update_will_force_fill(): void
    {
        $key = factory(ApiKey::class)->create(array_merge(
            $this->create,
            ['user_id' => $this->user->id],
        ));
        $this->service->update($key, $this->update, $this->extra);

        $this->assertDatabaseHas('api_keys', $this->update);

        $key = $this->user->apiKeys->first();
        $this->assertEquals($this->lastUsedAt, $key->last_used_at);
        $this->assertEquals($this->update['description'], $key->description);
    }
}
