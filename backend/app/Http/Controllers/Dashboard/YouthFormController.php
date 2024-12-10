<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\YouthForm;
use Illuminate\Http\Request;
use App\Services\SearchService;

class YouthFormController extends Controller
{
    public function index(Request $request)
    {
        // Initialize the query with a join to the users and user_profiles tables
        $query = YouthForm::query()
            ->join('users', 'youth_forms.user_id', '=', 'users.id')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id') // Join user_profiles table
            ->select('youth_forms.*', 'users.name as user_name', 'user_profiles.phone_number', 'user_profiles.city', 'user_profiles.address', 'user_profiles.birth_date');

        // Apply search filter using SearchService
        if ($search = $request->input('search')) {
            $searchFields = [
                'users.name',       // Search by user name
                'youth_forms.gender' // Search by gender
            ];
            $query = SearchService::apply($query, $searchFields, $search);
        }

        // Paginate and sort results
        $youthForms = $query->orderBy('youth_forms.created_at', 'desc')->paginate(9)->appends($request->query());

        return view('dashboard.youth-surveys.index', compact('youthForms'));
    }

    public function show($id)
    {
        // Initialize the query with a join to the users and user_profiles tables
        $youthForm = YouthForm::query()
            ->join('users', 'youth_forms.user_id', '=', 'users.id')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id') // Join user_profiles table
            ->select('youth_forms.*', 'users.name as user_name', 'user_profiles.phone_number', 'user_profiles.city', 'user_profiles.address', 'user_profiles.birth_date')
            ->where('youth_forms.id', $id)
            ->firstOrFail(); // Fetch the record or fail
    
        return view('dashboard.youth-surveys.show', compact('youthForm'));
    }
}
