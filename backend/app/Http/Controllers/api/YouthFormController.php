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
            'languages' => 'nullable|string',
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
        ]);

        // Store document if present
        if ($request->hasFile('document')) {
            $validated['document'] = $request->file('document')->store('documents', 'public');
        }

        
         // Create the youth form data
    $youthForm = YouthForm::create([
        'gender' => $validated['gender'],
        'is_it_graduate' => $validated['is_it_graduate'],
        'job_interest' => $validated['job_interest'],
        'motivation' => $validated['motivation'],
        'career_goals' => $validated['career_goals'],
        'project_ideas' => $validated['project_ideas'],
        'has_workshops' => $validated['has_workshops'],
        'workshop_clarify' => $validated['workshop_clarify'],
        'has_coding_experience' => $validated['has_coding_experience'],
        'coding_clarify' => $validated['coding_clarify'],
        'knows_other_languages' => $validated['knows_other_languages'],
        'languages' => json_encode($validated['languages']), // Encode to JSON()
        'creative_problem_solving' => $validated['creative_problem_solving'],
        'website_vs_webapp' => $validated['website_vs_webapp'],
        'usability_steps' => $validated['usability_steps'],
        'additional_info' => $validated['additional_info'],
        'document' => $validated['document'],
        'user_id' => $validated['user_id'],
        'phone_number' => $validated['phone_number'],
        'country' => $validated['country'],
        'city' => $validated['city'],
        'address' => $validated['address'],
        'birth_date' => $validated['birth_date'],
    ]);

        // Create the user profile data
        UserProfile::create([
            'user_id' => $validated['user_id'],
            'phone_number' => $validated['phone_number'],
            'country' => $validated['country'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'birth_date' => $validated['birth_date'],
          
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
