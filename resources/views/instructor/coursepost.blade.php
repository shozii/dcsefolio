@extends('instructor.layout')
@section('header')
<!-- Custom CSS -->
    <link href="http://localhost:8000/css/simple-sidebar.css" rel="stylesheet"></link>
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
  input.file_in{
    display: inline;
 }
  form.in,button.in{
    display: inline;
  }

  p{
    color:#003663;
    font-style: italic;
  }

</style>
@endsection

@section('navbar')
<li>
<a href="/course/{{$id}}/about"> About {{$c_c->name}} </a>
</li>
@endsection

@section('content')
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

        <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Course Post</div>

                <div class="panel-body">
                  
                  <form method="POST" action="/instructor_home/course/{{$id}}" enctype="multipart/form-data">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                   <input class="file_in" type="file" name="file">
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">POST</button>
                    </div>

                </form> 
                </div><!--panel body ends-->
            </div><!--panel ends-->
        </div>
    </div><!--row ends-->
    <div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
            <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="list-group hello">
                    @foreach($cposts as $cpost)    
                        @if($cpost->course_id==$id)                    
                        <li class="list-group-item post_style">
                         Title:{{ $cpost->title }}                             
                        </br>

                        @if($cpost->desc != null)
                        Description:{{ $cpost->desc }}   
                        </br></br>                       
                        @endif
                        
                        @if($cpost->image !=null)
                        <a href="{{ '/courseuploads/'.$cpost->image }}" download><img class="pull-right" src="{{ '/courseuploads/'.$cpost->image }}" width="80px" height="60px"></a>                      
                        </br>
                        @endif
                        
                        @if($cpost->file !=null)
                       <a href="{{'/courseuploads/'.$cpost->file}}" download>{{$cpost->file}}</a>
                        </br>
                        @endif
                         <!--Edit Button-->
                        <a href="/courses/{{$cpost->id}}/editpage">
                        <button type="button" class="btn btn-warning in" data-toggle="modal" data-target="#editModal">EditPost</button>
                        </a>
                        <!--Delete Button-->
                        <form class="in" method="POST" action="/courses/{{$cpost->id}}">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-danger in">Delete Post</button>
                        </form>     
                        <hr>
                        <p>{{$cpost->course->instructor->name}}</p>
                        @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

