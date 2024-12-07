<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobOpportunity;


class JobOpportunityController extends Controller
{
    public function index()
    {
        //pass full url by modifying imageUrl in cases of local storage and external url
        $opportunities = JobOpportunity::all()->map(function ($opportunity) {
            if ($opportunity->imgurl) {
                // check if the URL is an external URL
                if (filter_var($opportunity->imgurl, FILTER_VALIDATE_URL)) {
                    $opportunity->imgurl ?? $opportunity->imgurl;
                } else {
                    // generate the full URL for local storage
                    $opportunity->imgurl = "http://127.0.0.1:8000/storage/" . $opportunity->imgurl;
                }
            } else {
                $opportunity->imgurl = null;
            }

            return $opportunity;
        });

        return response()->json([
            'opportunities' => $opportunities,
        ], 200);
    }
}
