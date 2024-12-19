<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\YouthFormResource;
use App\Models\YouthForm;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Arr;

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
    $youthForm = YouthForm::create($validated);

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

     public function show($userId)
     {
         // Find the youth form where user_id matches the provided userId
         $youthForm = YouthForm::with(['user.profile'])
             ->where('user_id', $userId)
             ->firstOrFail();
     
         return new YouthFormResource($youthForm);
     }

     /**
 * Update an existing youth form submission.
 */
/**
 * Update an existing youth form submission.
 */
public function update(Request $request, $id)
{
    // Find the youth form by its ID
    $youthForm = YouthForm::findOrFail($id);

    // Validate the incoming request data
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
        'phone_number' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'birth_date' => 'nullable|date',
        'name' => 'nullable|string|max:255',
    ]);

    // Store document if present and update the field
    if ($request->hasFile('document')) {
        // If a new document is uploaded, update the field
        $validated['document'] = $request->file('document')->store('documents', 'public');
    } else {
        // Retain the previous document if no new document is uploaded
        $validated['document'] = $youthForm->document;
    }


    
    // Update the youth form data
    $youthForm->update($validated);

    // Update the user profile data
    $profile = UserProfile::where('user_id', $youthForm->user_id)->first();
    if ($profile) {
        $profile->update([
            'phone_number' => $validated['phone_number'] ?? $profile->phone_number,
            'country' => $validated['country'] ?? $profile->country,
            'city' => $validated['city'] ?? $profile->city,
            'address' => $validated['address'] ?? $profile->address,
            'birth_date' => $validated['birth_date'] ?? $profile->birth_date,
        ]);
    }

    // Update the user's name if provided
    if (isset($validated['name'])) {
        $user = User::find($youthForm->user_id);
        if ($user) {
            $user->update([
                'name' => $validated['name'],
            ]);
        }
    }

    return response()->json([
        'message' => 'Form updated successfully!',
        'data' => new YouthFormResource($youthForm),
    ]);
}
}
