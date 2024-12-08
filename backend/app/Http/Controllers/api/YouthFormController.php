<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\YouthForm;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


class YouthFormController extends Controller
{
    /**
     * Store a new youth form submission.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'is_it_graduate' => 'nullable|boolean',
            'job_interest' => 'nullable|string|max:255',
            'motivation' => 'nullable|string',
            'career_goals' => 'nullable|string',
            'project_ideas' => 'nullable|string',
            'has_workshops' => 'nullable|boolean',
            'has_coding_experience' => 'nullable|boolean',
            'knows_other_languages' => 'nullable|boolean',
            'creative_problem_solving' => 'nullable|string',
            'website_vs_webapp' => 'nullable|string',
            'usability_steps' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($request->hasFile('document')) {
            $validated['document'] = $request->file('document')->store('documents', 'public');
        }

        $youthForm = YouthForm::create($validated);

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
     * Fetch all youth form submissions.
     */
    public function index()
    {
        $forms = YouthForm::all();
        return response()->json($forms);
    }

    /**
     * Fetch a single youth form submission.
     */
    public function show($id)
    {
        $form = YouthForm::findOrFail($id);
        return response()->json($form);
    }

    /**
     * Delete a youth form submission.
     */
    public function destroy($id)
    {
        $form = YouthForm::findOrFail($id);

        if ($form->document) {
            Storage::disk('public')->delete($form->document);
        }

        $form->delete();

        return response()->json([
            'message' => 'Form deleted successfully!',
        ]);
    }
}
