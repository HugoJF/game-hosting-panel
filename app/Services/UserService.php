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
    /**
     * @param User  $user
     * @param array $form
     * @param array $data
     *
     * @return User
     */
	public function update(User $user, array $form, array $data = []): User
    {
		$user->fill($form);
		$user->forceFill($data);

		return save($user);
	}
}
