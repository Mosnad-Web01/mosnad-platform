<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CompanyForm;
use Illuminate\Http\Request;

class CompanyFormController extends Controller
{
    public function index()
    {
        $companyForms = CompanyForm::orderBy('created_at', 'desc')->paginate(9);
        return view('dashboard.company-surveys.index', compact('companyForms'));
    }
}
