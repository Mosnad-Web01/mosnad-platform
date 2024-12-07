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
        // $companyForms = CompanyForm::all();

        // // Decode JSON fields for readability
        // $companyForms->transform(function ($form) {
        //     $form->skills = json_decode($form->skills, true);
        //     $form->remote_hiring_preferences = json_decode($form->remote_hiring_preferences, true);
        //     return $form;
        // });

        // return response()->json($companyForms);
    }

    /**
     * Update the specified company form in storage.
     */
    public function update(Request $request, $id)
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

        try {
            // Find the company form by ID
            $companyForm = CompanyForm::findOrFail($id);

            // Update the company form data
            $companyForm->update([
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

            // Update user status to active
            $user = $companyForm->user;
            if ($user->status === 'suspended') {
                $user->status = 'active';
                $user->save();
            }

            return response()->json([
                'message' => 'Company form updated successfully!',
                'data' => $companyForm,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Company form not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }




    public function getCompanyByUserId($user_id)
    {
        try {
            $companyForm = CompanyForm::where('user_id', $user_id)->first();

            if (!$companyForm) {
                return response()->json(['error' => 'Company not found'], 404);
            }

            return response()->json([
                'company_name' => $companyForm->name,
                'company_id' => $companyForm->id,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


}
