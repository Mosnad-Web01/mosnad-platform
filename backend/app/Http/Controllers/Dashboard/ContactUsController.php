<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;


class ContactUsController extends Controller
{
    public function index()
    {
        $contactUsMessages = ContactUs::orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.contact-us.index', compact('contactUsMessages'));
    }

    public function show($id)
    {
        $message = ContactUs::findOrFail($id);

        return view('dashboard.contact-us.show', compact('message'));
    }

    
}
