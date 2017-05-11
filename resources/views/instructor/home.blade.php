@extends('instructor.layout')

@section('header')
<style>
.post_style{
    background-color:white;
    color:#2B2B2B;
    margin-top: 10px;
    width:700px;   
    border-radius: 5px;
    box-shadow: 2px 2px 10px rgba(1,1,1,0.2);
    padding: 20px;
    margin-bottom: 5px;
    transition: all 500ms ease;
    display:block; 
}
.post-style:hover{
    box-shadow: 2px 2px 12px rgba(1,1,1,0.7);
}
 .my-btn{
    background-color:#003663;
    color: white;
 }

 input.file_in{
    display: inline;
 }
  form.in,button.in{
    display: inline;
  }
  p{
    color: #003663;
    font-style: italic;
  }
 
</style>
<!-- Custom CSS -->
    <link href="/css/simple-sidebar.css" rel="stylesheet"></link>
@stop

@section('content')


<div class="container">

    <!--- Trigger the modal with a button -->
  <button type="button" class="btn btn-info form-control my-btn" data-toggle="modal" data-target="#myModal">Create Course</button>

  <!--//////////////////////// Modal //////////////////////////////////////-->
  <div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ url('/instructor_home/course') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="instructor_id" value="{{Auth::guard('web_instructor')->user()->id}}"></input>
        Course Code
        <input type="text" name="code" required></input>
        Course Name
        <input type="text" name="name" required></input>
        Semester
        <select name="semester" required>
          <option value="1st">First</option>
          <option value="2nd">Second</option>
          <option value="3rd">Third</option>
          <option value="4th">Fourth</option>
          <option value="5th">Fifth</option>
          <option value="6th">Sixth</option>
          <option value="7th">Seventh</option>
          <option value="8th">Eigth</option>
        </select>

        <div class="modal-footer">
        <button type="submit" class="btn my-btn">Create</button>
        </form>  
        </div>
      </div>
    </div>
    </div>
  </div>

   <!--//////////////////////// Modal Ends //////////////////////////////////////-->
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">  
            <ul class="sidebar-nav">
<!--////////////////////////////Course List////////////////////////////////////////-->
                @foreach($courses as $course)
                 @if(Auth::guard('web_instructor')->user()->id == $course->instructor_id)
                <li class="sidebar-brand">
                    <a href="{{$course->path()}}">
                        {{ $course->name }}
                    </a>
                </li> 
                @endif
                @endforeach  
<!--////////////////////////////Course List Ends////////////////////////////////////-->         
            </ul>
        </div>
    </div>
        <!-- end sidebar-wrapper -->
@if(Auth::guard('web_instructor')->user()->privileged == 1)
        <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Post News</div>

                <div class="panel-body">
                  
                  <form method="POST" action="{{ url('/instructor_home/posts')}}" enctype="multipart/form-data">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <input type="hidden" name="instructor_id" value="{{Auth::guard('web_instructor')->user()->id}}"></input>
                    <div class="form-group">
                    Post Title
                    <input name="title" class="form-control"></input>
                    </div>

                    <div class="form-group">
                    Post Description
                    <textarea name="desc" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                    Image
                   <input class="file_in" type="file" name="image">
                   Or<br>File  
                   <input class="file_in" type="file" name="p_file">
                    </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">POST</button>
                    </div>
                </form> 
                </div><!--panel body ends-->
            </div><!--panel ends-->
        </div>
    </div><!--row ends-->

</div> <!--container ends-->
@endif

<!-- displaying all posts-->
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
            <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="list-group hello" >
                    @foreach($posts as $post)                
                        <li class="list-group-item post_style">
                         Title: {{ $post->title }}                             
                        </br>
                        @if($post->desc != null)
                        Description: {{ $post->desc }}
                        </br></br> 
                        @endif                           
                        @if($post->image !=null)
                        <a href="{{ '/uploads/'.$post->image }}" download><img class="pull-right" src="{{ '/uploads/'.$post->image }}" width="100px" height="70px"></a>                      
                        </br>
                        @endif
                        
                        @if($post->p_file !=null)
                       <a href="{{'/files/'.$post->p_file}}" download>{{$post->p_file}}</a>
                         </br>
                        @endif 
                      
                        <a href="/posts/{{$post->id}}/editpage">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal">EditPost</button>
                        </a>
                        <form class="in" method="POST" action="/instructor_home/posts/{{$post->id}}">
                        <!-- Trigger the modal with a button -->
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-danger">Delete Post</button>
                        </form>
                        <hr>
                      <p>{{$post->instructor->name}}</p>
                      </li>
        @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection