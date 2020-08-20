<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/17/2019
 * Time: 9:08 PM
 */

namespace App\Services;

use App\Classes\PaymentSystem;
use App\Exceptions\PasswordAlreadySetException;
use App\Order;
use App\User;
use Illuminate\Support\Facades\Auth;

class AccountService
{
    public function preChecks(User $user): void
    {
        if (filled($user->password)) {
            throw new PasswordAlreadySetException;
        }
    }

    public function set(User $user, string $input): void
    {
        $this->preChecks($user);

        $user->password = bcrypt($input);
        $user->save();

        auth()->attempt([
            'email'    => $user->email,
            'password' => $input,
        ]);
    }
}
