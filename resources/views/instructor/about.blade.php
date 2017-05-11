@extends('instructor.layout')

<style type="text/css">

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
</style>

@section('navbar')
<li>
<a href="/course/{{$id}}/about"> About {{$course->name}} </a>
</li>
@endsection

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-8 col-md-offset-2 post-style">
 

                  @if($course->full_name==null)  
                  <form method="POST" action="/course/{{$id}}/about">
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <h2>Complete Info</h2>
                    <div class="form-group">
                    <input name="full_name" type="text" class="form-control" placeholder="Give Course Title"></input>
                    </div>

                    <div class="form-group">
                    <textarea name="description" class="form-control" placeholder="Give your course description here"></textarea>
                    </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form> 
                @else
                <h4>Course Code</h4>
                {{$course->code}}
                -
                {{$course->name}}
                <br>
                <hr>
                <h4>Course Name:</h4>
                {{ $course->full_name }}
                <br>
                <hr>
                <h4>Course Description</h4>
                {{$course->description}}
                <br>
                <hr>
                <h4>Created by:</h4>
                {{$course->instructor->name}}
                <br>
                <hr>
               @endif
          <form method="POST" action="/course/{{$id}}/delete">
            {{ method_field('DELETE') }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button class="btn btn-danger" type="submit">DELETE {{$course->name}}</button>
          <br>
          <hr>
          </form>     
       </div>
    </div><!--row ends-->
</div>
@endsection