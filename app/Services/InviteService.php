<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/17/2019
 * Time: 9:08 PM
 */

namespace App\Services;

use App\Notifications\UserInvited;
use App\Transaction;
use App\User;
use Illuminate\Auth\Events\Registered;

class InviteService
{
    public function invite(string $email, int $funds): User
    {
        ($user = new User)->forceFill([
            'email' => $email,
        ])->save();

        event(new Registered($user));

        (new Transaction)->forceFill([
            'user_id' => $user->id,
            'value'   => $funds,
        ])->save();

        $user->notify(new UserInvited($user));

        return $user;
    }
}
