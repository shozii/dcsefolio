<?php

namespace App\Http\Controllers\InstructorAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;

    //Auth facade
use Auth;
class LoginController extends Controller
{
	//Where to redirect seller after login.
    protected $redirectTo = '/instructor_home';

     //Trait
    use AuthenticatesUsers;
    //Custom guard for seller
    protected function guard()
    {
      return Auth::guard('web_instructor');
    }

    //Shows instructor login form
   public function showLoginForm()
   {
       return view('instructor.auth.login');
   }
}
