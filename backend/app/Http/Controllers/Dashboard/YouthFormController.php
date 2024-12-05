<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\YouthForm;
use Illuminate\Http\Request;

class YouthFormController extends Controller
{
    public function index()
    {
        $youthForms = YouthForm::orderBy('created_at', 'desc')->paginate(9);
        return view('dashboard.youth-surveys.index', compact('youthForms'));
    }
}
