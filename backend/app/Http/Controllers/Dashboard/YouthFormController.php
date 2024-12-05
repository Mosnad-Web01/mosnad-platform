<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\YouthForm;

class YouthFormController extends Controller
{
    public function index()
    {
        $youthForms = YouthForm::orderBy('created_at', 'desc')->paginate(9);
        return view('dashboard.youth-surveys.index', compact('youthForms'));
    }
    public function show($id)
    {
        $youthForm = YouthForm::findOrFail($id); // Retrieve survey by ID or fail
        return view('dashboard.youth-surveys.show', compact('youthForm'));
    }
}
