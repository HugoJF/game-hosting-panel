<?php

namespace Tests\Feature;

use App\Announcement;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AnnouncementTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setEnvironment(array $states)
    {
        factory(Announcement::class)->states($states)->create([
            'description' => 'Meu announcement',
        ]);

        return factory(User::class)->create();
    }

    public function test_announcement_will_be_displayed_when_not_expired_and_visible()
    {
        $this->browse(function (Browser $browser) {
            $user = $this->setEnvironment(['valid', 'visible']);

            $browser
                ->loginAs($user->id)
                ->visit(route('dashboard'))
                ->screenshot('dashboard')
                ->assertSee('Meu announcement');
        });
    }

    public function test_announcement_will_not_be_displayed_when_expired()
    {
        $this->browse(function (Browser $browser) {
            $user = $this->setEnvironment(['expired', 'visible']);

            $browser
                ->loginAs($user)
                ->visit(route('dashboard'))
                ->assertDontSee('Meu announcement');
        });
    }

    public function test_announcement_will_not_be_displayed_when_not_visible()
    {
        $this->browse(function (Browser $browser) {
            $user = $this->setEnvironment(['valid', 'hidden']);

            $browser
                ->loginAs($user)
                ->visit(route('dashboard'))
                ->assertDontSee('Meu announcement');
        });
    }
}
