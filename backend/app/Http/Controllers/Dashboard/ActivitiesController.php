<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ActivitiesController extends Controller
{
    public function index()
    {
        $activities = Activity::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new activity.
     */
    public function create()
    {
        return view('dashboard.activities.create');
    }

    /**
     * Store a newly created activity in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'activity_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp,svg|max:5048',
            'status' => 'required|in:published,draft',
        ]);
    
        try {
            // Handle image uploads
            if ($request->hasFile('images')) {
                $validatedData['images'] = array_map(function ($image) {
                    return $image->store('activity_images', 'public');
                }, $request->file('images'));
            }
    
            // Save the activity
            $activity = Activity::create($validatedData);
    
            if ($activity) {
                Session::flash('success', 'Activity created successfully!');
                return redirect()->route('activities.index');
            } else {
                Session::flash('error', 'An error occurred while creating the activity.');
                return back()->withInput();
            }
        } catch (\Exception $e) {
            Session::flash('error', 'An unexpected error occurred: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified activity.
     */
    public function show(Activity $activity)
    {
        return view('dashboard.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified activity.
     */
    public function edit(Activity $activity)
    {
        return view('dashboard.activities.edit', compact('activity'));
    }

    /**
     * Update the specified activity in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        // Validate the input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'activity_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp,svg|max:50048',
            'status' => 'required|in:published,draft',
        ]);
    
        try {
            // Handle image uploads
            if ($request->hasFile('images')) {
                $validatedData['images'] = array_map(function ($image) {
                    return $image->store('activity_images', 'public');
                }, $request->file('images'));
            } else {
                // Keep existing images if not updated
                $validatedData['images'] = $activity->images;
            }
    
            // Update the activity
            $activity->update($validatedData);
    
            Session::flash('success', 'Activity updated successfully!');
            return redirect()->route('activities.index');
        } catch (\Exception $e) {
            Session::flash('error', 'An unexpected error occurred: ' . $e->getMessage());
            return back()->withInput();
        }
    }
    

    /**
     * Remove the specified activity from storage.
     */
    public function destroy(Activity $activity)
    {
        try {
            // Delete images
            $imagesPaths = $activity->images ?? [];
            foreach ($imagesPaths as $imagePath) {
                // Get the relative path of the image to delete it
                $imagePath = str_replace(Storage::url(''), '', $imagePath);
                Storage::disk('public')->delete($imagePath);
            }

            // Delete the activity
            $activity->delete();

            // Flash success message
            Session::flash('success', 'Activity deleted successfully!');
            return redirect()->route('activities.index');
        } catch (\Exception $e) {
            // Log the exception or handle errors
            Session::flash('error', 'An unexpected error occurred: ' . $e->getMessage());
            return back();
        }
    }
}
