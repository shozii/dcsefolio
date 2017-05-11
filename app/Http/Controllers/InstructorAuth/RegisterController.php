<?php

namespace App\Http\Controllers\InstructorAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Validator facade used in validator method
use Illuminate\Support\Facades\Validator;

//Instructor Model
use App\Instructor;

//Auth Facade used in guard
use Auth;

class RegisterController extends Controller
{

    protected $redirectPath = 'instructor_home';

    //shows registration form to instructor
    public function showRegistrationForm()
    {
        return view('instructor.auth.register');
    }

  //Handles registration request for instructor
    public function register(Request $request)
    {

       //Validates data
        $this->validator($request->all())->validate();

       //Create instructor
        $instructor = $this->create($request->all());
    
        //Authenticates instructor
        $this->guard()->login($instructor);

       //Redirects instructors
        return redirect($this->redirectPath);
    }

    //Validates user's Input
    protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:instructors',
            'password' => 'required|min:6|confirmed',
            'token' => 'required|min:4|exists:tokens,token'
        ]);

    }

    //Create a new instructor instance after a validation.
    protected function create(array $data)
    {

        return Instructor::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => $data['token'],
        ]);
    }

    //Get the guard to authenticate instructor
   protected function guard()
   {
       return Auth::guard('web_instructor');
   }

}