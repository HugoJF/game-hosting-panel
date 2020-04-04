<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 8/3/2019
 * Time: 9:00 AM
 */

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class BasePolicy
{
	use HandlesAuthorization;

	/**
	 * @param $user
	 * @param $ability
	 *
	 * @return bool
	 */
	public function before($user, $ability)
	{
		if ($user->admin)
			return true;
	}
}