<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\CoursePost;
use DB;
class CoursePostController extends Controller
{
    public function show($id){

    	$courses=Course::orderBy('created_at', 'desc')->get();
    	$cposts=CoursePost::orderBy('created_at', 'desc')->get();
        $c_c=Course::find($id);
    	return view('instructor.coursepost', compact('courses','cposts','id','c_c'));
    }

      public function show_user($id){

        $courses=Course::all();
        $cposts=CoursePost::all();
        $c_c=Course::find($id);
        return view('coursepost', compact('courses','cposts','id','c_c'));
    }



    public function store(Request $request, $id){
        
    	
        $cpost=new CoursePost();
        $cpost->title=$request->title;
        $cpost->desc=$request->desc;
        if($request->image!=null){

            $cpost->image=$request->image;
            $name=$cpost->image->getClientOriginalName();
            $cpost->image->move(public_path().'/courseuploads/', $name);
            $cpost->image = $request->image->getClientOriginalName();

        }

        if($request->file!=null){
        
            $cpost->file=$request->file;
            $name=$cpost->file->getClientOriginalName();
            $cpost->file->move(public_path().'/courseuploads/', $name);
            $cpost->file = $request->file->getClientOriginalName();
    
        }
        

        $cpost->course_id=$id;
        $cpost->save();
    	return back();
    }

    public function delete($id)
    {
        DB::table('course_posts')->where('id', '=',$id )->delete();
        return back();
    }

    public function editpage($id)
    {
        $cpost=CoursePost::find($id);
        return view('instructor.editcourse', compact('cpost'));
    }

    public function edit(Request $request,$id)
    {
        
         DB::table('posts')
           ->where('id',$id )
           ->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'image' => $request->image,
            'p_file' => $request->p_file
            ]);

            if($request->image!=null){

           
            $name=$post->image->getClientOriginalName();
            $post->image->move(public_path().'/uploads/', $name);
            

        }

        if($request->p_file!=null){

            $name=$post->p_file->getClientOriginalName();
            $post->p_file->move(public_path().'/files/', $name);
        
        }

        return redirect('instructor_home/course/id');
    }
}

