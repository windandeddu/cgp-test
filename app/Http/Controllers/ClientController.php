<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ClientController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $clients = Client::paginate(15);

        return view('clients.index', compact('clients'));
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        $companies = Company::all();
        return view('clients.create',  compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreClientRequest $request): Redirector|RedirectResponse|Application
    {
        $validated = $request->validated();

        $client = Client::create($validated);
        $client->companies()->sync($request->safe()->companies);

        return redirect(route('clients.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return Factory|View|Application
     */
    public function edit(Client $client): Factory|View|Application
    {
        $clientCompanies = $client->companies;

        return view('clients.edit', compact('client', 'clientCompanies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientRequest $request
     * @param Client $client
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateClientRequest $request, Client $client): Redirector|RedirectResponse|Application
    {
        $request->clientId = $client->id;
        $validated = $request->validated();
        $client->update($validated);
        $client->companies()->sync($request->safe()->companies);

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return Redirector|Application|RedirectResponse
     */
    public function destroy(Client $client): Redirector|Application|RedirectResponse
    {
        $client->delete();
        return redirect(route('clients.index'));
    }
}
