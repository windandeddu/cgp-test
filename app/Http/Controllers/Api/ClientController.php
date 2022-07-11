<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Client;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientController extends Controller
{
    protected int $perPage = 10;

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return AnonymousResourceCollection
     */
    public function client_companies(Client $client): AnonymousResourceCollection
    {
        return CompanyResource::collection($client->companies()->paginate($this->perPage));
    }
}
