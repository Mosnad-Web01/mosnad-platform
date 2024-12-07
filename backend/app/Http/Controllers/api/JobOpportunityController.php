<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Models\JobOpportunity;

class JobOpportunityController  extends Controller
{

    public function index()
    {
        $opportunities = JobOpportunity::all();
        return response()->json([
            'opportunities' => $opportunities,
        ], 200);
    }
}
