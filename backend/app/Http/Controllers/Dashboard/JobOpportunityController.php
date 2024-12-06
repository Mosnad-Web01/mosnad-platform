<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JobOpportunity;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class JobOpportunityController extends Controller
{

    public function index()
    {

        // Load job opportunities with applicants count
        $jobOpportunities = JobOpportunity::withCount('applicants')->latest()->paginate(10);

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
    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'required_skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'position_level' => 'nullable|string',
            'other_criteria' => 'nullable|string',
            'imgurl' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'end_date' => 'nullable|date|after:today',
        ]);


        // Handle the image upload if provided
        if ($request->hasFile('imgurl')) {
            $imagePath = $request->file('imgurl')->store('job_opportunities', 'public');
            $validatedData['imgurl'] = $imagePath;
        }

        // Save the jobopportunity
        $jobOpportunity = JobOpportunity::create($validatedData);
        if ($jobOpportunity) {
            Session::flash('success', 'تم إنشاء فرصة العمل بنجاح  !');
            return redirect()->route('job-opportunities.index');
        } else {
            Session::flash('error', 'حدث خطأ أثناء إنشاء فرصة العمل  . ');
            return back()->withInput();
        }
    }

}
