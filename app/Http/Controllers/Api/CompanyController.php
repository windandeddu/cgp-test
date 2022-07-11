<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{
    protected int $perPage = 10;
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function companies(): AnonymousResourceCollection
    {
        return CompanyResource::collection(Company::paginate($this->perPage));
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return AnonymousResourceCollection
     */
    public function clients(Company $company): AnonymousResourceCollection
    {
        return ClientResource::collection($company->clients()->paginate($this->perPage));
    }
}
