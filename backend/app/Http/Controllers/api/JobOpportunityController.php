<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobOpportunity;
use Illuminate\Http\Request;


class JobOpportunityController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 6;
        $page = $request->query('page', 1) || 1;

        $opportunities = JobOpportunity::where('is_approved', true)->latest()
            ->paginate($perPage, ['*'], 'page', $page);

        //process image for each blog
        $opportunities->getCollection()->transform(function ($opportunity) {
            $opportunity->imgurl = $this->processImage($opportunity->imgurl);
            return $opportunity;
        });

        return response()->json([
            'opportunities' => $opportunities->items(),
            'success' => true,
            'current_page' => $opportunities->currentPage(),
            'last_page' => $opportunities->lastPage(),
            'total' => $opportunities->total(),

        ], 200);
    }

    // public function show($id)
    // {
    //     $oppotunity = JobOpportunity::find($id);

    //     if (!$oppotunity) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'oppotunity not found.',
    //         ], 404);
    //     }

    //     if ($oppotunity->imgurl) {
    //         // check if the URL is an external URL
    //         if (filter_var($oppotunity->imgurl, FILTER_VALIDATE_URL)) {
    //             $oppotunity->imgurl ?? $oppotunity->imgurl;
    //         } else {
    //             // generate the full URL for local storage
    //             $oppotunity->imgurl = "http://127.0.0.1:8000/storage/" . $oppotunity->imgurl;
    //         }
    //     } else {
    //         $oppotunity->imgurl = null;
    //     }


    //     return response()->json([
    //         'success' => true,
    //         'oppotunity' => $oppotunity,
    //     ], 200);
    // }


    private function processImage($image)
    {


    if(filter_var($image, FILTER_VALIDATE_URL)){
        return $image;
    }else{
        return "http://127.0.0.1:8000/storage/" . $image;
    }

    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        if (empty($query)) {
            return response()->json([
                'success' => true,
                'opportunities' => [],
                'message' => 'No search query provided',
            ]);
        }

        try {

            $opportunities = JobOpportunity::where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('required_skills', 'LIKE', "%{$query}%");
            })->where('is_approved', true)
                ->latest()
                ->get();

            // Transforming images
            $opportunities = $opportunities->map(function ($opportunity) {
                $opportunity->imgurl = $this->processImage($opportunity->imgurl);
                return $opportunity;
            });

            return response()->json([
                'success' => true,
                'opportunities' => $opportunities,
                'message' => $opportunities->count() > 0 ? 'Job Opportunities found' : 'No Job Opportunities found',
            ]);

        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Search error: ', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Error performing search',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
