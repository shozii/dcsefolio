<?php

namespace App\Http\Controllers\InstructorAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
class ResetPaswordController extends Controller
{
    //trait for handling reset Password
    use ResetsPasswords;
    //Show form to seller where they can reset password
    public function showResetForm(Request $request, $token = null)
    {
        return view('instructor.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
