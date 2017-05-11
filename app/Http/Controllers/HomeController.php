<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Http\Request;
use App\Post;
use App\Course;
use App\User;
class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $courses=Course::orderBy('created_at', 'desc')->get();
        return view('home', compact('posts','courses'));
    }
 
    public function profile($id)
    { 
        $user=User::find($id);  
        json_encode($user);
        return view('porfile', compact('user'));
    }

    public function edit_semester(Request $request, $id){
        User::where('id', $id)->update(['semester' => $request->semester]);
        return back();
    }
}