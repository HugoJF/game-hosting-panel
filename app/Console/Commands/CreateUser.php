<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $email = $this->ask("What is the new user's email address?");
        $firstName = $this->ask("What is the new user's first name?");
        $lastName = $this->ask("What is the new user's last name?");
        $username = $this->ask("What is the new user's username?");
        $password = $this->secret("What is the new user's password?");
        $admin = $this->confirm('Is this user an admin?', false);
        $serverLimit = $this->ask('What is the server limit for this user?', 10);

        User::unguard();
        $user = User::query()->create([
            'first_name'   => $firstName,
            'last_name'    => $lastName,
            'username'     => $username,
            'email'        => $email,
            'admin'        => $admin,
            'password'     => bcrypt($password),
            'server_limit' => $serverLimit,
        ]);

        event(new Registered($user));
        $this->info("User $firstName $lastName created!");
    }
}
