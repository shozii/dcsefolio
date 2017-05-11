<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use DB;
class CourseController extends Controller
{

    public function store(Request $request)
    {

    	 $this->validate($request,[
            'code' => 'required',
            'name' => 'required',
            'semester' => 'required'
            ]);
         
    	$course=Course::create($request->all());

        $course->save();    
    	return back();
    }

    public function about($id){
        $course=Course::find($id);
        return view('instructor.about',compact('id','course'));
    }

    public function about_user($id)
    {
        $course=Course::find($id);
        return view('about',compact('id','course'));   
    }

    public function update(Request $request,$id){

       DB::table('courses')
           ->where('id',$id )
           ->update(['full_name' => $request->full_name ,'description'=>$request->description]);
            
        return back();
    }
    public function delete($id){
       DB::table('courses')->where('id', '=',$id )->delete();
       return redirect('/instructor_home');
    }

 }
