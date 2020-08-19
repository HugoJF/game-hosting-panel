<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Forms\PasswordForms;
use App\Services\PasswordService;
use App\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function set(PasswordService $service, PasswordForms $forms, User $user)
    {
        $service->preChecks($user);

        return view('form', [
            'title'       => 'Setting a password',
            'form'        => $forms->set($user),
            'submit_text' => 'Set password',
        ]);
    }

    public function update(PasswordService $service, Request $request, User $user)
    {
        $service->set($user, $request->input('password'));

        flash()->success('Password successfully set!');

        return redirect()->route('home');
    }
}
