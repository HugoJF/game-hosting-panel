<?php

namespace App\Http\Controllers\Admin;

use App\Forms\LocationForm;
use App\Http\Controllers\Controller;
use App\Location;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class LocationController extends Controller
{
    public function show(Location $location)
    {
        return view('admins.locations.show', compact('location'));
    }

    public function edit(FormBuilder $builder, Location $location)
    {
        $form = $builder->create(LocationForm::class, [
            'method' => 'PATCH',
            'url'    => route('admins.locations.update', $location),
            'model'  => $location,
        ]);

        return view('form', [
            'title'       => 'Editing location',
            'form'        => $form,
            'submit_text' => 'Update',
        ]);
    }

    public function update(Request $request, Location $location)
    {
        $location->fill($request->all());
        $location->save();

        flash()->success('Location updated!');

        return redirect()->route('admins.dashboard');
    }
}
