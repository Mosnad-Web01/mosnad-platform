<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $roleId = $request->input('role_id');

        // prevent registration for role_id 1 (Admin)
        if ($roleId == 1) {
            return response()->json(['message' => 'Admins cannot register'], 403);
        }

        // validation rules based on role
        $commonRules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|integer|in:2,3',
        ];

        if ($roleId == 2) {
            // if role_id is 2 (Company role), add company_name as required field
            $commonRules['company_name'] = 'required|string|max:255';
        }

        // validate request
        $validator = Validator::make($request->all(), $commonRules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->messages(),
            ], 422);
        }

        // combine first_name and last_name into name to be passed to user table
        $name = $request->input('first_name') . ' ' . $request->input('last_name');

        // Create user
        $credentials = $request->only('email', 'password', 'role_id');
        $credentials['password'] = Hash::make($credentials['password']);
        $credentials['name'] = $name; // use combined name
        $user = User::create($credentials);

        // create company record if role_id is 2 (Company role)
        if ($roleId == 2) {

            // TODO: After creating company table

            // $user->companies()->create([
            //     'company_name' => $request->input('company_name'),
            // ]);
        }

        // generate token
        $token = $user->createToken($user->name)->plainTextToken;

        return response()->json([
            'user' => $user,
            'role' => $user->role->name,
            'status' => $user->status,
            'token' => $token,
        ], 200);
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->messages(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        // prevent login for role_id 1 (Admin)
        if ($user->role_id === 1) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken($user->name)->plainTextToken;

        return response()->json([
            'user' => $user,
            'role' => $user->role->name,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json([
                'message' => 'Logged out successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to log out',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
