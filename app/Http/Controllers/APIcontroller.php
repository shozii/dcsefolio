<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\CoursePost;
use App\Post;
use DB;
use App\Instructor;
use App\User;

class APIcontroller extends Controller
{
    public function coursesStudent($id)
    {
    	$user=User::find($id);
        $courses=Course::where('semester', $user->semester)->get();
        return json_encode($courses);
    }

    public function coursesInstructor($id)
    {
       $courses=Course::where('instructor_id', $id)->get();
       return json_encode($courses);

    }

    public function courseposts($id)
    {
    	$cposts=CoursePost::where('course_id', $id)->get();
        return json_encode($cposts);
    }

    public function posts()
    {
    	return Post::all();
    }
    
    public function instructorpost($id)
    {
    	return Post::where('instructor', $id)->get();
    }

    public function loginStudent($email)
    {
        $false=['false'];
        $user=User::where('email', $email)->get();
        if($user=='[]')
            return $false;
        else
            return $user;
        
    }

    public function loginInstructor($email)
    {
        $false=['false'];
        $instructor=Instructor::where('email',$email)->get();
        if($instructor=='[]')
            return $false;
        else
            return $instructor;

    }
}