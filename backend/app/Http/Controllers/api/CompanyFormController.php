<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\CompanyForm;
use App\Http\Controllers\Controller;

class CompanyFormController extends Controller
{
    /**
     * Store a newly created company form in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'industry' => 'nullable|string|max:255',
            'employees' => 'nullable|string|max:255',
            'stage' => 'nullable|string|max:255',
            'skills' => 'nullable|array', // Expect an array for multiple selections
            'home_workers' => 'nullable|string|max:255',
            'training' => 'nullable|string|max:255',
            'hiring' => 'nullable|string|max:255', 
            'remote_hiring_preferences' => 'nullable|array', // Expect an array for preferences
            'additional_notes' => 'nullable|string',
        ]);

        // Save the company form data
        $companyForm = CompanyForm::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'industry' => $validated['industry'],
            'employees' => $validated['employees'],
            'stage' => $validated['stage'],
            'skills' => json_encode($validated['skills']), // Encode to JSON
            'home_workers' => $validated['home_workers'],
            'training' => $validated['training'],
            'hiring' => $validated['hiring'],
            'remote_hiring_preferences' => json_encode($validated['remote_hiring_preferences']), // Encode to JSON
            'additional_notes' => $validated['additional_notes'],
        ]);

        return response()->json(['message' => 'Company form submitted successfully!', 'data' => $companyForm], 201);
    }

    /**
     * Display a listing of the company forms.
     */
    public function index()
    {
        $companyForms = CompanyForm::all();

        // Decode JSON fields for readability
        $companyForms->transform(function ($form) {
            $form->skills = json_decode($form->skills, true);
            $form->remote_hiring_preferences = json_decode($form->remote_hiring_preferences, true);
            return $form;
        });

        return response()->json($companyForms);
    }
}