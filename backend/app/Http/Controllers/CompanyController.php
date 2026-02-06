<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $companies = Company::all();
        return view('companies',[
            'companies' => $companies,
            'user' => auth()->user()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): View
    {
        $company->load('games');
        return view('companies.show', compact('company'));
    }
}
