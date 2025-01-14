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
            // Paginate activities, excluding those with 'draft' status, and order by created_at descending
            $activities = Activity::where('status', '!=', 'draft')
                ->orderBy('created_at', 'desc') // Order by creation date (new to old)
                ->paginate(20)
                ->map(function ($activity) {
                    // Handle the images field
                    if ($activity->images) {
                        // Ensure images is an array
                        $activity->images = is_array($activity->images)
                            ? array_map(function ($image) {
                                if (filter_var($image, FILTER_VALIDATE_URL)) {
                                    return $image; // External URL
                                } else {
                                    return "http://127.0.0.1:8000/storage/" . $image; // Local storage URL
                                }
                            }, $activity->images)
                            : [$activity->images]; // If it's a string, convert it into an array
                    } else {
                        $activity->images = null;
                    }

                    return $activity;
                });

            return response()->json($activities, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching activities: ' . $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        try {
            // Find the activity by ID, excluding drafts
            $activity = Activity::where('id', $id)->where('status', '!=', 'draft')->firstOrFail();

            // Handle the images field
            if ($activity->images) {
                // Ensure images is an array
                $activity->images = is_array($activity->images)
                    ? array_map(function ($image) {
                        if (filter_var($image, FILTER_VALIDATE_URL)) {
                            return $image; // External URL
                        } else {
                            return "http://127.0.0.1:8000/storage/" . $image; // Local storage URL
                        }
                    }, $activity->images)
                    : [$activity->images]; // If it's a string, convert it into an array
            } else {
                $activity->images = null;
            }

            return response()->json($activity, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Activity not found or is in draft status: ' . $e->getMessage()], 404);
        }
    }
}
