<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JobOpportunity;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

        return view('dashboard.job-opportunities.show', compact('jobOpportunity'));
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
            'required_skills' => 'required|string',
            'experience' => 'required|string',
            'position_level' => 'required|string',
            'other_criteria' => 'required|string',
            'imgurl' => 'required|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'end_date' => 'required|date|after:today',
        ]);


        // add is_approved by admin
        $validatedData['is_approved'] = true;

        // Handle the image upload if provided
        if ($request->hasFile('imgurl')) {
            $imagePath = $request->file('imgurl')->store('job_opportunities', 'public');
            $validatedData['imgurl'] = $imagePath;
        }

        // Save the jobopportunity
        $jobOpportunity = JobOpportunity::create($validatedData);
        if ($jobOpportunity) {
            Session::flash('success', 'تم إنشاء فرصة العمل بنجاح   !');
            return redirect()->route('job-opportunities.index');
        } else {
            Session::flash('error', 'حدث خطأ أثناء إنشاء فرصة العمل  . ');
            return back()->withInput();
        }
    }

    public function edit(JobOpportunity $jobOpportunity)
    {
        return view('dashboard.job-opportunities.edit', compact('jobOpportunity'));
    }
    public function update(Request $request, JobOpportunity $jobOpportunity)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'required_skills' => 'string',
            'experience' => 'string',
            'position_level' => 'string',
            'other_criteria' => 'string',
            'imgurl' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'end_date' => 'required|date|after:today',
        ]);

        // Handle the image upload if a new image is provided
        if ($request->hasFile('imgurl')) {
            $imagePath = $request->file('imgurl')->store('job_opportunities', 'public');
            $validatedData['imgurl'] = $imagePath;

            // Optionally, delete the old image from storage
            if ($jobOpportunity->imgurl) {
                \Storage::disk('public')->delete($jobOpportunity->imgurl);
            }
        }

        // update the job opportunity
        $jobOpportunity->update($validatedData);

        // flash a success message
        Session::flash('success', 'تم تحديث فرصة العمل بنجاح ! ');
        return redirect()->route('job-opportunities.index');
    }

    public function destroy(JobOpportunity $jobOpportunity)
    {
        // check if the job opportunity has an associated image
        if ($jobOpportunity->imgurl) {
            // delete the image from public storage
            Storage::disk('public')->delete($jobOpportunity->imgurl);
        }
        $jobOpportunity->delete();

        // flash a success message
        Session::flash('success', ' تم حذف فرصة العمل بنجاح  ! ');
        return redirect()->route('job-opportunities.index');
    }

}
