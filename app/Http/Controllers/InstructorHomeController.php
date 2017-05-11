<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Course;
use Auth;
class InstructorHomeController extends Controller
{

       /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function show()
    {  
        $posts= Post::orderBy('created_at', 'desc')->get();
        $courses=Course::orderBy('created_at', 'desc')->get();
        return view('instructor.home', compact('posts','courses'));
    }
}
