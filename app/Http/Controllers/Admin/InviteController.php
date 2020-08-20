<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InviteRequest;
use App\Services\Forms\InviteForms;
use App\Services\InviteService;

class InviteController extends Controller
{
    public function create(InviteForms $forms)
    {
        return view('form', [
            'title'       => 'Invite form',
            'form'        => $forms->create(),
            'submit_text' => 'Invite',
        ]);
    }

    public function store(InviteService $service, InviteRequest $request)
    {
        $service->invite($request->input('email'), $request->input('funds'));

        flash()->success('User invited!');

        return redirect()->route('admins.dashboard');
    }
}
