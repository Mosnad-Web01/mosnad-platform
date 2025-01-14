<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JobOpportunity;
use App\Models\Bootcamp;
use App\Models\YouthForm;
use App\Models\CompanyForm;
use App\Models\ContactUs;



class DashboardController extends Controller
{
    public function index()
    {
        //count of job opportunities
        $opportunities = JobOpportunity::count();

        //count of bootcamps
        $bootcamps = Bootcamp::count();

        //count of users
        $users = User::count();

        //count of youth surveys
        $youthSurveys = YouthForm::count();

        //count of company surveys
        $companySurveys = CompanyForm::count();
        //count of contact us messages
        $contactUs = ContactUs::count();

        return view('dashboard.index', compact('opportunities', 'bootcamps', 'users', 'youthSurveys', 'companySurveys', 'contactUs'));

    }
}
