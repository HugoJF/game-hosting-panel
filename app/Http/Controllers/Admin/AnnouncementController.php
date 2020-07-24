<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use App\Http\Controllers\Controller;
use App\Services\Forms\AnnouncementForms;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    // TODO: validar
    // TODO: campo visible
    // TODO: cada um tem o seu template
    // TODO: tempusdominus
    // TODO: atualizar master layout para corrigir o sidebar

    public function index(): void
    {

    }

    public function show(Announcement $announcement): void
    {

    }

    public function create(AnnouncementForms $forms)
    {
        $form = $forms->create();

        return view('form', [
            'title'       => trans('announcements.creating'),
            'form'        => $form,
            'submit_text' => trans('words.create'),
        ]);
    }

    public function store(Request $request)
    {
        $announcement = new Announcement;

        $announcement->fill($request->all()); // TODO: validate

        $announcement->save();

        return redirect()->route('admins.dashboard');
    }

    public function edit(AnnouncementForms $forms, Announcement $announcement)
    {
        $form = $forms->edit($announcement);

        return view('form', [
            'title'       => trans('announcements.updating'),
            'form'        => $form,
            'submit_text' => trans('update'),
        ]);
    }

    public function update(Request $request, Announcement $announcement)
    {
        $announcement->update($request->all() + ['visible' => false]);

        $announcement->save();

        flash()->success(trans('announcements.updated'));

        return redirect()->route('admins.dashboard');
    }
}
