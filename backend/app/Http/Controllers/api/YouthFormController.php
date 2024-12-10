<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\YouthFormResource;
use App\Models\YouthForm;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class YouthFormController extends Controller
{
    /**
     * Store a new youth form submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gender' => 'nullable|string|max:255',
            'is_it_graduate' => 'nullable|boolean',
            'job_interest' => 'nullable|string|max:255',
            'motivation' => 'nullable|string',
            'career_goals' => 'nullable|string',
            'project_ideas' => 'nullable|string',
            'has_workshops' => 'nullable|boolean',
            'workshop_clarify' => 'nullable|string',
            'has_coding_experience' => 'nullable|boolean',
            'coding_clarify' => 'nullable|string',
            'knows_other_languages' => 'nullable|boolean',
            'languages' => 'nullable|array',
            'creative_problem_solving' => 'nullable|string',
            'website_vs_webapp' => 'nullable|string',
            'usability_steps' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'user_id' => 'required|exists:users,id',
            'phone_number' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'user_type' => 'required|in:youth,company',
        ]);

        // Store document if present
        if ($request->hasFile('document')) {
            $validated['document'] = $request->file('document')->store('documents', 'public');
        }

        // Create the youth form data
        $youthForm = YouthForm::create($validated);

        // Create the user profile data
        UserProfile::create([
            'user_id' => $validated['user_id'],
            'phone_number' => $validated['phone_number'],
            'country' => $validated['country'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'birth_date' => $validated['birth_date'],
            'user_type' => $validated['user_type'],
        ]);

        // Fetch the user and update status if necessary
        $user = $youthForm->user;
        if ($user->status === 'suspended') {
            $user->status = 'active';
            $user->save();
        }

        return response()->json([
            'message' => 'Form submitted successfully!',
            'data' => $youthForm,
        ], 201);
    }

    /**
     * Fetch a single youth form submission, along with related user and profile data.
     */

     public function show($id)
     {
         // Fetch the youth form along with the related user profile data
         $youthForm = YouthForm::with(['user.profile'])
             ->where('id', $id)
             ->firstOrFail();
     
         // Return the formatted data using the YouthFormResource
         return new YouthFormResource($youthForm);
     }
}
