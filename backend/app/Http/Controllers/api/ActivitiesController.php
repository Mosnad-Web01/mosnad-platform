<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the activities.
     */
    public function index()
    {
        try {
            // Paginate activities
            $activities = Activity::paginate(10);
            return response()->json($activities, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching activities: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified activity.
     */
    public function show($id)
    {
        try {
            // Find the activity by ID
            $activity = Activity::findOrFail($id);
            return response()->json($activity, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Activity not found: ' . $e->getMessage()], 404);
        }
    }
}
