<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/23/2019
 * Time: 2:47 AM
 */

namespace App\Services;

use App\User;

class UserService
{
	public function updateUser(User $user, array $data)
	{
		$user->fill(collect($data)->only(['name', 'server_limit', 'server_expiration_days', 'email'])->toArray());

		$user->server_limit = intval($data['server_limit']);
		$user->server_expiration_days = intval($data['server_expiration_days']);

		$user->save();
	}
}