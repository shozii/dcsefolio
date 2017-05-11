<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use App\Instructor;
use Auth;
use DB;
class PostController extends Controller
{
    public function store(Request $request)
    {

    	$this->validate($request,[
            'title' => 'required',
            'image' => 'mimes:jpeg,bmp,png,gif',
            'file' =>  'size:20000',
        ]);

        $post=new Post();
        
        $post->title=$request->title;
        $post->desc=$request->desc;

        if($request->image!=null){

            $post->image=$request->image;
            $name=$post->image->getClientOriginalName();
            $post->image->move(public_path().'/uploads/', $name);
            $post->image = $request->image->getClientOriginalName();

        }

        if($request->p_file!=null){

            $post->p_file=$request->p_file;
            $name=$post->p_file->getClientOriginalName();
            $post->p_file->move(public_path().'/files/', $name);
            $post->p_file = $request->p_file->getClientOriginalName();
        
        }
        
        $post->instructor_id=$request->instructor_id;

        $post->save();

  
        
    	//$instructor->addPost($post,Auth::guard('web_instructor')->user()->id);
    	return back();
    }

    public function delete($id)
    {
        DB::table('posts')->where('id', '=',$id )->delete();
        return back();
    }

    public function editpage($id)
    {
        $post=Post::find($id);
        return view('instructor.edit', compact('post'));
    }

    public function edit(Request $request,$id)
    {
        
         $post=Post::where('id',$id )   
           ->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'image' => $request->image,
            'p_file' => $request->p_file
            ]);

        return redirect('/instructor_home');
    }

}

