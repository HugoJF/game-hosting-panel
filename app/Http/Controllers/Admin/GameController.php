<?php

namespace App\Http\Controllers\Admin;

use App\Classes\PterodactylApi;
use App\Forms\GameForm;
use App\Game;
use App\Http\Controllers\Controller;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class GameController extends Controller
{
    public function show(Pterodactyl $api, Game $game)
    {
        $resource = $api->egg($game->nest_id, $game->id);

        dd($resource);
    }

    public function edit(FormBuilder $builder, Game $game)
    {
        $form = $builder->create(GameForm::class, [
            'method' => 'PATCH',
            'url'    => route('admins.games.update', $game),
            'model'  => $game,
        ]);

        return view('form', [
            'title'       => 'Updating game',
            'form'        => $form,
            'submit_text' => 'Update',
        ]);
    }

    public function update(Request $request, Game $game)
    {
        $game->fill($request->all());
        $game->save();

        flash()->success("Game <strong>$game->name</strong> updated!");

        return redirect()->route('admins.dashboard');
    }
}
