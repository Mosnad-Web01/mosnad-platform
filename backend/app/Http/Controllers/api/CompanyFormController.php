<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\CompanyFormResource;
use Illuminate\Http\Request;
use App\Models\CompanyForm;
use App\Http\Controllers\Controller;
use App\Models\UserProfile;

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
            'user_id' => 'required|exists:users,id',
            'phone_number' => 'required|string|max:15',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);

        try {
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
                'user_id' => $validated['user_id'],
            ]);

            // Create user profile data
            UserProfile::create([
                'user_id' => $validated['user_id'],
                'phone_number' => $validated['phone_number'],
                'country' => $validated['country'],
                'city' => $validated['city'],
                'address' => $validated['address'],
                'birth_date' => $validated['birth_date'],
            ]);

            // Fetch user and update state if necessary
            $user = $companyForm->user;
            if ($user->status == 'suspended') {
                $user->status = 'active';
                $user->save();
            }

            return response()->json([
                'message' => 'Company form submitted successfully',
                'data' => $companyForm,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
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
        'company_name' => 'nullable|string|max:255', // Validate company name
        'industry' => 'nullable|string|max:255',
        'employees' => 'nullable|string|max:255',
        'stage' => 'nullable|string|max:255',
        'skills' => 'nullable|array',
        'home_workers' => 'nullable|string|max:255',
        'training' => 'nullable|string|max:255',
        'hiring' => 'nullable|string|max:255',
        'remote_hiring_preferences' => 'nullable|array',
        'additional_notes' => 'nullable|string',
        'phone_number' => 'required|string|max:15',
        'country' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'birth_date' => 'required|date',
    ]);
    
    try {
        // Find the company form by ID
        $companyForm = CompanyForm::findOrFail($id);
    
        // Update user data (name and email)
        $user = $companyForm->user;
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
    
        // If company_name is provided, update it
        if (isset($validated['company_name'])) {
            $companyForm->update([
                'company_name' => $validated['company_name'],
            ]);
        }

        // Update the company form data (without name and email)
        $companyForm->update([
            'industry' => $validated['industry'],
            'employees' => $validated['employees'],
            'stage' => $validated['stage'],
            'skills' => json_encode($validated['skills']),
            'home_workers' => $validated['home_workers'],
            'training' => $validated['training'],
            'hiring' => $validated['hiring'],
            'remote_hiring_preferences' => json_encode($validated['remote_hiring_preferences']),
            'additional_notes' => $validated['additional_notes'],
        ]);
    
        // Update or create user profile data
        UserProfile::updateOrCreate(
            ['user_id' => $companyForm->user_id],
            [
                'phone_number' => $validated['phone_number'],
                'country' => $validated['country'],
                'city' => $validated['city'],
                'address' => $validated['address'],
                'birth_date' => $validated['birth_date'],
            ]
        );
    
        // Update user status to active if suspended
        if ($user->status === 'suspended') {
            $user->status = 'active';
            $user->save();
        }
    
        // Refresh the company form to get updated relationships
        $companyForm->load('user');
    
        return response()->json([
            'message' => 'Company form updated successfully!',
            'data' => [
                'company_form' => $companyForm,
                'user' => $user,
            ],
        ], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Company form not found'], 404);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}


public function show($userId)
{
    $companyForm = CompanyForm::with(['user.profile'])
        ->where('user_id', $userId)
        ->firstOrFail();

    return new CompanyFormResource($companyForm);
}



    /**
     * Retrieve the company form for a given user ID.
     */
    public function getCompanyInfoByUserId($user_id)
{
    try {
        $companyForm = CompanyForm::with('user')->where('user_id', $user_id)->first();

        if (!$companyForm) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        return response()->json([
            'company_name' => $companyForm->company_name, // Get company_name from company_form
            'user_name' => $companyForm->user->name,       // Get user name
            'email' => $companyForm->user->email,          // Get user email
            'company_id' => $companyForm->id,              // Get company form ID
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

}
