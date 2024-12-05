<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JobOpportunity;

use Illuminate\Http\Request;

class JobOpportunityController extends Controller
{

    public function index()
    {
        //with pagination
        $jobOpportunities = JobOpportunity::paginate(10);
        return view('dashboard.job-opportunities.index', compact('jobOpportunities'));
    }

}
