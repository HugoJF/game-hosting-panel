<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Forms\UserForms;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function edit(UserForms $forms, User $user)
	{
		$form = $forms->edit($user);

		return view('form', [
			'title'       => "Updating user $user->name",
			'form'        => $form,
			'submit_text' => 'Update',
		]);
	}

	public function update(UserService $service, Request $request, User $user)
	{
		$service->update($user, $request->all());

		flash()->success("User $user->name updated!");

		return redirect()->route('admins.users');
	}
}
