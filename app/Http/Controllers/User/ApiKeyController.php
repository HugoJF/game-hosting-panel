<?php

namespace App\Http\Controllers\User;

use App\ApiKey;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiKeyStoreRequest;
use App\Http\Requests\ApiKeyUpdateRequest;
use App\Services\ApiKeyService;
use App\Services\Forms\ApiKeyForms;
use Illuminate\Support\Facades\Auth;

class ApiKeyController extends Controller
{
	public function index()
	{
		$keys = auth()->user()->apiKeys()->latest()->get();

		return view('api-keys.index', compact('keys'));
	}

	public function create(ApiKeyForms $forms)
	{
		$form = $forms->create();

		return view('form', [
			'title'       => 'Creating new API Key',
			'form'        => $form,
			'submit_text' => 'Create API Key',
		]);
	}

	public function edit(ApiKeyForms $forms, ApiKey $key)
	{
		$form = $forms->edit($key);

		return view('form', [
			'title'       => 'Updating API key',
			'form'        => $form,
			'submit_text' => 'Update',
		]);
	}

	public function store(ApiKeyService $service, ApiKeyStoreRequest $request)
	{
		$key = $service->store(Auth::user(), $request->validated());

		flash()->success("API key <strong>$key->id</strong> created successfully!");

		return redirect()->route('api-keys.index');
	}

	public function update(ApiKeyService $service, ApiKeyUpdateRequest $request, ApiKey $key)
	{
		$service->update($key, $request->validated());

		flash()->success('API key successfully updated!');

		return redirect()->route('api-keys.index');
	}

	public function destroy(ApiKey $key)
	{
		$key->delete();

		flash()->success('API key deleted!');

		return redirect()->route('api-keys.index');
	}
}
