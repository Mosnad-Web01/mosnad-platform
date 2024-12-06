<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JobOpportunity;

use Illuminate\Http\Request;

class JobOpportunityController extends Controller
{

    public function index()
    {

        // Load job opportunities with applicants count
        $jobOpportunities = JobOpportunity::withCount('applicants')->paginate(10);

        return view('dashboard.job-opportunities.index', compact('jobOpportunities'));
    }
    public function show(JobOpportunity $jobOpportunity)
    {
        // return view('dashboard.job-opportunities.show', compact('jobOpportunity'));
    }
    public function create()
    {
        return view('dashboard.job-opportunities.create');

    }


}
