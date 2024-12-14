<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        try {
            // Validate the input
            $validated = $request->validate([
                'current_password' => ['required', 'string'],
                'new_password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['required', 'string', 'same:new_password'],
            ], [
                'current_password.required' => 'يرجى إدخال كلمة المرور الحالية',
                'new_password.required' => 'يرجى إدخال كلمة المرور الجديدة',
                'new_password.min' => 'يجب أن تكون كلمة المرور الجديدة على الأقل 8 أحرف',
                'confirm_password.required' => 'يرجى تأكيد كلمة المرور الجديدة',
                'confirm_password.same' => 'كلمة المرور الجديدة وتأكيد كلمة المرور لا تتطابق'
            ]);

            // Check if the current password is correct
            if (!Hash::check($validated['current_password'], Auth::user()->password)) {
                return response()->json([
                    'status' => 'error',
                    'errors' => [
                        'current_password' => ['كلمة المرور الحالية غير صحيحة']
                    ]
                ], 422);
            }

            // Update the password
            $user = User::find(Auth::id());
            $user->password = Hash::make($validated['new_password']);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'تم تغيير كلمة المرور بنجاح'
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى'
            ], 500);
        }
    }

    public function updateEmail(Request $request)
{
    try {
        // Validate the input
        $validated = $request->validate([
            'email' => ['required', 'email', 'unique:users,email,' . Auth::id()],
        ], [
            'email.required' => 'يرجى إدخال البريد الإلكتروني',
            'email.email' => 'يرجى إدخال بريد إلكتروني صالح',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقًا',
        ]);

        // Update the email
        $user = User::find(Auth::id());
        $user->email = $validated['email'];
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث البريد الإلكتروني بنجاح',
            'email' => $user->email
        ], 200);

    } catch (ValidationException $e) {
        return response()->json([
            'status' => 'error',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى'
        ], 500);
    }
}



}