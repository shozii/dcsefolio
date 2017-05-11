@extends('layouts.app')

<style type="text/css">
.my-card{
        background-color: white;
        color: #003663;
        display: block;
}
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
<a href="/about/{{$id}}">About {{$course->name}}</a>
</li>
@endsection

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-6 col-md-offset-2 post-style">
 
                <h4>Course Code</h4>
                {{$course->code}}
                -
                {{$course->name}}
                <br>
                <hr>
                <h4>Course Name:</h4>
                @if($course->full_name!=null)
                {{ $course->full_name }}
                @else
                {{ "Full Name is not provided yet"}}
                @endif
                <br>
                <hr>
                @if($course->full_name!=null)
                <h4>Course Description</h4>
                {{$course->description}}
                @else
                {{ "Description is not provided yet" }}
                @endif
                <br>
                <hr>
                <h4>Created by:</h4>
                {{$course->instructor->name}}
                <br>
                <hr>
        </div>
        </div>
    </div>    

@endsection