<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/23/2019
 * Time: 2:44 AM
 */

namespace App\Services\Forms;

use App\Forms\UserForm;
use App\User;
use Kris\LaravelFormBuilder\Form;

class UserForms extends ServiceForm
{
	public function edit(User $user): Form
    {
		return $this->formBuilder->create(UserForm::class, [
			'method' => 'PATCH',
			'url'    => route('users.update', $user),
			'model'  => $user,
		], compact('user'));
	}
}
