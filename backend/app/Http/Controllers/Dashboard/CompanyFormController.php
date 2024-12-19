<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CompanyForm;
use Illuminate\Http\Request;

class CompanyFormController extends Controller
{
    public function index()
    {
        $companyForms = CompanyForm::with('user') // Include the user relationship
            ->orderBy('created_at', 'desc')
            ->paginate(9);
    
        return view('dashboard.company-surveys.index', compact('companyForms'));
    }

    public function show($id)
    {
        $companyForm = CompanyForm::with('user')->findOrFail($id); // Include the user relationship
        return view('dashboard.company-surveys.show', compact('companyForm'));
    }


}
