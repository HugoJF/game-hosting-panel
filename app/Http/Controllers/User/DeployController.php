<?php

namespace App\Http\Controllers\User;

use App\Deploy;
use App\Http\Controllers\Controller;
use App\Server;
use App\Services\Forms\DeployForms;
use App\Services\DeployService;
use App\Services\ServerService;
use Illuminate\Http\Request;

class DeployController extends Controller
{
	public function start(Deploy $deploy)
	{
		$deploy->start();

		flash()->success('Server started!');

		return back();
	}

	public function stop(Deploy $deploy)
	{
		$deploy->stop();

		flash()->success('Server stopped!');

		return back();
	}

	public function show(Deploy $deploy)
	{
		return redirect('servers.show', $deploy->server);
	}

	public function create(DeployForms $createForm, Server $server)
	{
		$form = $createForm->create($server);

		return view('form', [
			'title'       => "Deploying server $server->name",
			'form'        => $form,
			'submit_text' => 'Deploy',
		]);
	}

	public function edit(DeployForms $forms, Deploy $deploy)
	{
		$form = $forms->edit($deploy);

		return view('form', [
			'title'       => 'Updating deploy parameters',
			'form'        => $form,
			'submit_text' => 'Update',
		]);
	}

	public function store(DeployService $service, Request $request, Server $server)
	{
		$deploy = $service->storeDeploy($server, $request->all());

		if (!$deploy)
			return back();

		flash()->success('Server deployed successfully!');

		return redirect()->route('servers.show', $server);
	}

	public function update(DeployService $service, Request $request, Deploy $deploy)
	{
		$service->updateDeploy($deploy, $request->all());

		flash()->success('Server deployed updat succesfully!');

		return redirect()->route('servers.show', $deploy->server);
	}

	public function terminate(ServerService $service, Server $server)
	{
		$deploy = $service->getCurrentDeploy($server);

		if (!$deploy)
			return back();

		$deploy->terminated = true;

		flash()->success('Server deploy set to terminate!');

		return back();
	}

	public function forceTerminate(ServerService $service, Server $server)
	{
		$deploy = $service->getCurrentDeploy($server);

		if (!$deploy)
			return back();

		$deploy->terminate();

		flash()->success('Server deploy forcefully terminated!');

		return back();
	}
}
