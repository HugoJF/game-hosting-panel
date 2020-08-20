<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Forms\AccountSetupForms;
use App\Services\AccountService;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function set(AccountService $service, AccountSetupForms $forms, User $user)
    {
        $service->preChecks($user);

        return view('form', [
            'title'       => 'Setting a password',
            'form'        => $forms->set($user),
            'submit_text' => 'Set password',
        ]);
    }

    public function update(AccountService $service, Request $request, User $user)
    {
        $service->set($user, $request->input('password'));

        flash()->success('Password successfully set!');

        return redirect()->route('home');
    }
}
