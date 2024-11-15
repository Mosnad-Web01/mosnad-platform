<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginDashboardController extends Controller
{
    /**
     * Show the login form.
     */
    public function index()
    {
        // Redirect to the dashboard if the user is already authenticated
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        return view('dashboard.auth.login'); // Render the login view
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        // Validate the login request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Prevent session fixation attacks
            return redirect()->route('dashboard.index'); // Redirect to dashboard
        }

        // If login fails, redirect back with error
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect()->route('dashboard.login'); // Redirect to login page
    }
}
