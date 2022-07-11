<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\SearchCompanyResource;
use App\Models\Company;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector as RedirectorAlias;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $companies = Company::paginate(15);

        return view('companies.index',  compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyRequest $request
     * @return RedirectorAlias|Application|RedirectResponse
     */
    public function store(StoreCompanyRequest $request): RedirectorAlias|Application|RedirectResponse
    {
        $validated = $request->validated();

        Company::create($validated);

        return redirect(route('companies.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return Factory|View|Application
     */
    public function edit(Company $company): Factory|View|Application
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @return RedirectorAlias|Application|RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, Company $company): RedirectorAlias|Application|RedirectResponse
    {
        $validated = $request->validated();
        $company->update($validated);

        return redirect(route('companies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return RedirectorAlias|Application|RedirectResponse
     */
    public function destroy(Company $company): RedirectorAlias|Application|RedirectResponse
    {
        $company->delete();
        return redirect(route('companies.index'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $data = [];
        if($request->filled('q')){
            $data = SearchCompanyResource::collection(
                Company::select(['id', 'name'])
                    ->where('name', 'LIKE', '%' . $request->get('q'). '%')
                    ->get()
            );
        }

        return response()->json($data);
    }
}
