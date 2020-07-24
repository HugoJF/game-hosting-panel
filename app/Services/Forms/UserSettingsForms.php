<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/23/2019
 * Time: 2:44 AM
 */

namespace App\Services\Forms;

use App\Forms\UserForm;
use App\Forms\UserSettingsForm;
use App\User;
use Kris\LaravelFormBuilder\Form;

class UserSettingsForms extends ServiceForm
{
	public function settings(User $user): Form
    {
		return $this->formBuilder->create(UserSettingsForm::class, [
			'method' => 'PATCH',
			'url'    => route('settings.update'),
			'model'  => $user,
		]);
	}
}
